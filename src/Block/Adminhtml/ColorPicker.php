<?php
/**
 * An improved configuration suite for Magento 2 admins and developers.
 *
 * @category  Iods
 * @version   000.1.0 (100.1.0-v1)
 * @author    Rye Miller <rye@drkstr.dev>
 * @copyright Copyright (c) 2021, Rye Miller (http://ryemiller.io)
 * @license   MIT (https://en.wikipedia.org/wiki/MIT_License)
 */
declare(strict_types=1);

namespace Iods\Configs\Block\Adminhtml;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class ColorPicker extends Field
{

    protected function _getElementHtml(AbstractElement $element): string
    {
        $html = $element->getElementHtml();
        $value = $element->getData('value');

        $html .= '
        <script>
            require([
            "jquery",
            "jquery/colorpicker/js/colorpicker",
            "domReady!"
            ], function ($) {
                let $el = $("#' . $element->getHtmlId() . '");
                $el.css("backgroundColor", "' . $value . '");
                
                // attach color picker
                $el.colorPicker({
                    color: "' . $value . '",
                    onchange: function (hsb, hex) {
                        $el.css("backgroundColor", "#" + hex).val("#" + hex);
                    }
                })
            });
        </script>
        ';
        return $html;
    }
}