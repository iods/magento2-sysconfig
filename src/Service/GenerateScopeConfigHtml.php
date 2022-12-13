<?php
/**
 * Configuration management support for Magento 2. Whatever that means.
 *
 * @package   Iods\SysConfig
 * @author    Rye Miller <rye@drkstr.dev>
 * @copyright Copyright (c) 2022, Rye Miller (http://ryemiller.io)
 * @license   See LICENSE for license details.
 */
declare(strict_types=1);

use Magento\Framework\App\ResourceConnection;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class GenerateScopeConfigHtml
 * @package Iods\SysConfig\Service
 */
class GenerateScopeConfigHtml
{
    public const CONFIG_TABLE = 'core_config_data';

    /** @var bool|null */
    protected ?bool $_is_raw = null;

    protected mixed $_config_data = null;

    /** @var ResourceConnection */
    protected ResourceConnection $_resource_connection;

    /** @var StoreManagerInterface */
    protected StoreManagerInterface $_store_manager;

    /** @var array */
    private array $_items = [];

    /** @var array */
    private array $_items_cache = [];

    public function __construct(
        ResourceConnection $resource_connection,
        StoreManagerInterface $store_manager
    ) {
        $this->_store_manager = $store_manager;
        $this->_resource_connection = $resource_connection;
    }

    public function getScopeConfigHtml(string $path): string
    {
        $default = $this->getConfigValue($path, 'default', 0);
        $websites = $this->getConfigValue($path, 'websites', 0);
        $stores = $this->getConfigValue($path, 'stores', 0);

        $html[] = $this->renderHtml('default', 0, 'Default', $default, $path);

        $map = $this->getStoreMap();

        foreach ($map as $website_id => $store_ids) {
            $website = $this->getConfigItems('website', $website_id);
            $html[] = $this->renderHtml('websites', $website_id, $website['name'], $websites, $path);
            foreach ($store_ids as $store_id => $store_code) {
                $store = $this->getConfigItems('store', $store_id);
                $html[] = $this->renderHtml('stores', $store_code, $store['name'], $stores, $path);
            }
        }

        if (!array_key_exists($path, $this->_items)) {
            $html[] = sprintf('<div class="default_config_note">%s</div>', __('This configuration key uses the default key from config.xml'));
        }

        return '<ul>' . implode('', $html) . '</ul>';
    }

    private function getConfigItems($type, $id): mixed
    {
        if (!isset($this->_items_cache[$type][$id])) {
            switch ($type) {
                case 'website':
                    $website = $this->_store_manager->getWebsite($id);
                    $this->_items_cache[$type][$id] = [
                        'name' => $website->getName(),
                        'code' => $website->getCode()
                    ];
                    break;
                case 'store':
                    $store = $this->_store_manager->getStore($id);
                    $this->_items_cache[$type][$id] = [
                        'name' => $store->getName(),
                        'code' => $store->getCode()
                    ];
                    break;
            }
        }

        return $this->_items_cache[$type][$id];
    }

    private function getStoreMap(): array
    {
        $map = [];
        $stores = $this->_store_manager->getStores();

        foreach ($stores as $store) {
            $map[$store->getWebsiteId()][$store->getId()] = $store->getCode();
        }

        return $map;
    }

    private function queryConfigData(): ?array
    {
        if ($this->_config_data === null) { // @TODO add strict comparison for bool if is set or not
            $db = $this->_resource_connection->getConnection();

            $query = $db->select()
                        ->from($this->_resource_connection->getTableName(self::CONFIG_TABLE));

            $this->_config_data = $db->fetchAll($query);
        }

        return $this->_config_data;
    }

    private function getConfigValue($path, string $scope, int $scope_id)
    {
        foreach ($this->queryConfigData() as $data) {
            if ($data['path'] === $path && $data['scope'] === $scope && $data['scope_id'] === $scope_id) {
                return $data['value'];
            }
        }

        return false;
    }

    private function renderHtml(string $scope, int $scope_id, string $scope_label, mixed $value, $path): string
    {
        if ($value === false) {
            $label = __('-- NOT SET --');
        } else {
            $label = $value;
            $this->_items[$path] = true;
        }

        $html = sprintf('<li class="%s">', $scope);
        $html .= sprintf('<span class="scope-%s %s">%s (%s): %s</span>', $scope, $value === false ? 'inherits' : 'value_set', $scope_label, $scope_id, $label);
        $html .= '</li>';

        return $html;
    }

}