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

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class AddScopeConfigHtmlPlugin
{
    protected GenerateScopeConfigHtml $_html_service;

    public function __construct(
        GenerateScopeConfigHtml $html_service
    ) {
        $this->_html_service = $html_service;
    }

    public function afterRender(Field $subject, $result, AbstractElement $element)
    {
        $document = new \DOMDocument();

        try {
            $document->loadHTML('<?xml encoding="utf-8" ?>' . $result, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        } catch (\Exception $e){
            return $result;
        }

        $path = $element->getDataByPath('path') . '/' . $element->getId();
        $html = $this->_html_service->getScopeConfigHtml($path);

        $new = $document->createElement('div');

        $fragment = $document->createDocumentFragment();
        $fragment->appendXML('<div class="scope_information_trigger">[Scoped values]</div>');
        $fragment->appendXML('<div class="scope_information_content">' . $html . '</div>');

        $new->appendChild($fragment);
        $new->setAttribute('class', 'scopehint');

        $labels = $document->getElementsByTagName('label');
        $label = $labels->item(0);

        $label?->appendChild($new);

        return $document->saveHTML();
    }
}