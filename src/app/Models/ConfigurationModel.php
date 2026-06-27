<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class ConfigurationModel extends Model
{
    protected $cache;

    public function __construct()
    {
        parent::__construct();
        $this->cache = Services::cache();
    }

    protected $table = 'configurations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'setting',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $beforeInsert = ['setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedBy'];

    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[40]|is_unique[configurations.name,id,{id}]',
        'setting' => 'required|trim'
    ];

    protected $cachePrefix = 'config_';
    protected $defaultCacheTTL = 3600;

    /**
     * Get configuration value by name
     */
    public function getConfig(string $name, $default = null)
    {
        $cacheKey = $this->cachePrefix . md5($name);
        $cache = Services::cache();

        if ($cached = $cache->get($cacheKey)) {
            return $cached;
        }

        $value = $this->getUncachedConfig($name, $default);

        $cacheDuration = $this->getCacheDuration();
        $cache->save($cacheKey, $value, $cacheDuration);

        return $value;
    }

    /**
     * Get configuration directly from database
     */
    protected function getUncachedConfig(string $name, $default = null)
    {
        $config = $this->where('name', $name)->first();
        return $config ? $this->parseSetting($config['setting']) : $default;
    }

    /**
     * Determine cache duration
     */
    protected function getCacheDuration(): int
    {
        $duration = $this->getUncachedConfig('website_cache', $this->defaultCacheTTL);
        return (int) $duration;
    }

    /**
     * Set configuration value (automatically clears cache)
     */
    public function setConfig(string $name, $value): bool
    {
        $settingValue = is_array($value) ? json_encode($value) : $value;
        $config = $this->where('name', $name)->first();

        $result = $config
            ? $this->update($config['id'], ['setting' => $settingValue])
            : (bool) $this->insert(['name' => $name, 'setting' => $settingValue]);

        if ($result) {
            $this->clearConfigCache($name);
            if ($name === 'website_cache') {
                $this->clearConfigCache();
            }
        }

        return $result;
    }

    /**
     * Clear configuration cache
     */
    public function clearConfigCache(?string $name = null): bool
    {
        $cache = Services::cache();

        if ($name) {
            return $cache->delete($this->cachePrefix . md5($name));
        }

        return $cache->deleteMatching($this->cachePrefix . '*');
    }

    /**
     * Get all configurations
     */
    public function getAllConfigs(): array
    {
        $cacheKey = $this->cachePrefix . 'all_configs';
        if ($cached = $this->cache->get($cacheKey)) {
            return $cached;
        }

        $configs = [];
        foreach ($this->where('deleted_at', null)->findAll() as $config) {
            $configs[$config['name']] = $this->parseSetting($config['setting']);
        }

        $this->cache->save($cacheKey, $configs, $this->getCacheDuration());
        return $configs;
    }

    /**
     * Parse setting value
     */
    protected function parseSetting($value)
    {
        if (is_string($value)) {
            if (str_starts_with($value, '[') || str_starts_with($value, '{')) {
                $decoded = json_decode($value, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    return $decoded;
                }
            }

            if ($value === 'true')
                return true;
            if ($value === 'false')
                return false;

            if (is_numeric($value)) {
                return strpos($value, '.') !== false ? (float) $value : (int) $value;
            }
        }

        return $value;
    }

    public function getCurrencies(): array
    {
        return (array) $this->getConfig('currencies', []);
    }

    public function getDefaultCurrency(): string
    {
        return $this->getConfig('default_currency', 'GBP');
    }

    public function getTimezone(): string
    {
        return $this->getConfig('time_zone', 'Europe/London');
    }

    protected function setCreatedBy(array $data): array
    {
        if (function_exists('user_id')) {
            $data['data']['created_by'] = user_id();
        }
        return $data;
    }

    protected function setUpdatedBy(array $data): array
    {
        if (function_exists('user_id')) {
            $data['data']['updated_by'] = user_id();
        }
        return $data;
    }
}
