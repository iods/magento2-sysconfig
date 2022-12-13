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

namespace Iods\SysConfig\Plugin;

use Iods\SysConfig\Helper\Module;
use Magento\Framework\Acl\AclResource\Provider;


class AddSortOrderToResourceLabelPlugin
{
    /** @var Module */
    private Module $_module;

    public function __construct(
        Module $module
    ) {
        $this->_module = $module;
    }

    public function afterGetAclResources(Provider $subject, array $result): array
    {
        if (!$this->_module->isEnabledResources()) {
            return $result;
        }

        return $this->processResource($result);
    }

    protected function processResource(array $resources): array
    {
        foreach ($resources as $key => $resource) {
            if (isset($resource['sort_order']) && isset ($resource['title'])) {
                $resource['title'] = sprintf(
                    "%s | id %s | ord %s",
                    $resource['title'] ?? '',
                    $resource['id'] ?? '',
                    $resource['sortOrder'] ?? '',
                );
            }

            if (isset($resource['children'])) {
                $resource['children'] = $this->processResource($resource['children']);
            }

            $resources[$key] = $resource;
        }

        return $resources;
    }
}