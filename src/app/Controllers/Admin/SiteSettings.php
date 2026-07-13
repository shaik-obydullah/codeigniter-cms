<?php

namespace App\Controllers\Admin;

class SiteSettings extends BaseController
{
    public function index()
    {
        $settings = model('SettingsModel')->findAll();

        $formatted = [];
        foreach ($settings as $setting) {
            $formatted[$setting->key] = $setting->value;
        }

        return $this->adminView('site-settings', [
            'pageTitle' => 'Site Settings',
            'settings'  => $formatted,
        ]);
    }

    public function update()
    {
        $settingsModel = model('SettingsModel');

        $regularKeys = [
            'site_name', 'site_tagline', 'site_email', 'site_description',
            'theme_mode', 'items_per_page', 'time_format', 'date_format',
            'time_zone', 'website_cache',
        ];

        $checkboxes = ['maintenance_mode', 'allow_registration'];

        $socialMap = [
            'github_url'   => ['class' => 'social', 'key' => 'github'],
            'linkedin_url' => ['class' => 'social', 'key' => 'linkedin'],
            'twitter_url'  => ['class' => 'social', 'key' => 'twitter'],
            'youtube_url'  => ['class' => 'social', 'key' => 'youtube'],
        ];

        foreach ($regularKeys as $key) {
            $value = $this->request->getPost($key);
            if ($value === null) {
                continue;
            }

            $existing = $settingsModel->where('key', $key)->first();

            if ($existing) {
                $settingsModel->update($existing->id, ['value' => $value]);
            } else {
                $settingsModel->insert(['class' => '', 'key' => $key, 'value' => $value, 'type' => 'string']);
            }
        }

        foreach ($checkboxes as $key) {
            $value = $this->request->getPost($key) ? '1' : '0';

            $existing = $settingsModel->where('key', $key)->first();

            if ($existing) {
                $settingsModel->update($existing->id, ['value' => $value]);
            } else {
                $settingsModel->insert(['class' => '', 'key' => $key, 'value' => $value, 'type' => 'boolean']);
            }
        }

        foreach ($socialMap as $formKey => $db) {
            $value = $this->request->getPost($formKey) ?? '';

            $existing = $settingsModel->where('class', $db['class'])->where('key', $db['key'])->first();

            if ($existing) {
                $settingsModel->update($existing->id, ['value' => $value]);
            } else {
                $settingsModel->insert(['class' => $db['class'], 'key' => $db['key'], 'value' => $value, 'type' => 'string']);
            }
        }

        $this->activityModel->log(
            auth()->id(),
            'settings.updated',
            'Updated site settings',
            'settings',
            null
        );

        return redirect()->to('/dashboard/site-settings')->with('message', 'Settings updated successfully.');
    }
}
