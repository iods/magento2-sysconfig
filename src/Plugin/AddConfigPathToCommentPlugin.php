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
use Magento\Framework\Phrase;
use Magento\Config\Model\Config\Structure\Element\Field;

class AddConfigPathToCommentPlugin
{
    /** @var Module */
    private Module $_module;

    public function __construct(
        Module $module
    ) {
        $this->_module = $module;
    }

    public function afterGetComment(Field $subject, Phrase|string $result): Phrase|string
    {
        if (!$this->_module->isEnabled() || !$this->_module->isEnabledPaths()) {
            return $result;
        }

        $data = $subject->getData();
        $result = (string) $result;
        $prefix = strlen($result) > 0 ? "<br /><br />" : "";

        $result .= $prefix . $subject->getPath();

        if (isset($data['comment']['model'])) {
            $result .= "<br>Comment model: {$data['comment']['model']}";
        }

        return __($result);
    }
}