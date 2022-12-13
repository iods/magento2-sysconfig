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
use Magento\Config\Model\Config\Structure\Converter;

class AddSortOrderToLabelPlugin
{
    /** @var Module */
    private Module $_module;

    public function __construct(
        Module $module
    ) {
        $this->_module = $module;
    }

    public function afterConvert(Converter $subject, array $result): array
    {
        if (!$this->_module->isEnabled() || $this->_module->isEnabledSortOrder()) {
            return $result;
        }

        $result['config']['system']['tabs'] = $this->processField($result['config']['system']['tabs'] ?? []);

        $result['config']['system']['sections'] = $this->processField($result['config']['system']['sections'] ?? []);

        return $result;
    }

    protected function processField(array $components): array
    {
        foreach ($components as $key => $element) {
            if (isset($element['sortOrder'])) {
                $element['label'] = sprintf(
                    '%s | order %s',
                    $element['label'] ?? '',
                    $element['sortOrder'],
                );
            }

            if (isset($element['children'])) {
                $element['children'] = $this->processField($element['children']);
            }

            $components[$key] = $element;
        }

        return $components;
    }
}