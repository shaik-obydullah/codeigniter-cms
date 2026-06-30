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
        $keys = ['site_name', 'site_tagline', 'site_email', 'site_description', 'github_url', 'linkedin_url', 'twitter_url', 'youtube_url', 'theme_mode', 'items_per_page', 'maintenance_mode', 'allow_registration'];

        foreach ($keys as $key) {
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

        $this->activityModel->log(
            auth()->id(),
            'settings.updated',
            'Updated site settings',
            'settings',
            null
        );

        return redirect()->to('/admin/site-settings')->with('message', 'Settings updated successfully.');
    }
}
