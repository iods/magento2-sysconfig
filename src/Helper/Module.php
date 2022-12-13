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

namespace Iods\SysConfig\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Module
{
    public const CONFIG_PATH_ENABLED = 'base/base_config/sysconfig_enabled';
    public const CONFIG_PATH_SORT_ORDER_ENABLED = 'same';
    public const CONFIG_PATH_PATHS_ENABLED = 'same';
    public const CONFIG_PATH_RESOURCES_ENABLED = 'same';

    private ScopeConfigInterface $_scope_config;

    public function __construct(
        ScopeConfigInterface $scope_config
    ) {
        $this->_scope_config = $scope_config;
    }

    public function isEnabled(): bool
    {
        return $this->_scope_config->isSetFlag(self::CONFIG_PATH_ENABLED);
    }

    public function isEnabledSortOrder(): bool
    {
        return $this->_scope_config->isSetFlag(self::CONFIG_PATH_SORT_ORDER_ENABLED);
    }

    public function isEnabledPaths(): bool
    {
        return $this->_scope_config->isSetFlag(self::CONFIG_PATH_PATHS_ENABLED);
    }

    public function isEnabledResources(): bool
    {
        return $this->_scope_config->isSetFlag(self::CONFIG_PATH_RESOURCES_ENABLED);
    }
}