<?php

namespace App\Controllers;
use App\Models\ConfigurationModel;

class Documentation extends BaseController
{
    protected $db;

    public function wordpress_restaurant_pos_lite_plugin()
    {
        $configModel = new ConfigurationModel();
        $configList = $configModel->getAllConfigs();

        $data = [
            'title' => 'Restaurant POS Lite',
            'settings' => $configList,
            'date_format' => $configList['date_format'],
        ];

        return view('website/doc/wordpress_restaurant_pos_lite_plugin', data: [
            'header' => view('website/header', $data),
            'footer' => view('website/footer', $data),
        ]);
    } 

    public function lime_css_framework()
    {
        $configModel = new ConfigurationModel();
        $configList = $configModel->getAllConfigs();

        $data = [
            'title' => 'Lime CSS Framework',
            'settings' => $configList,
            'date_format' => $configList['date_format'],
        ];

        return view('website/doc/lime_css_framework', data: [
            'header' => view('website/header', $data),
            'footer' => view('website/footer', $data),
        ]);
    }
}