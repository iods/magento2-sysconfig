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

namespace Iods\Configs\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;

class Ranges extends AbstractFieldArray
{
    /** @var TaxColumn */
    private TaxColumn $_taxRenderer;

    protected function _prepareToRender()
    {
        $this->addColumn('from_qty', ['label' => __('From'), 'class' => 'required-entry']);
        $this->addColumn('to_qty', ['label' => __('To'), 'class' => 'required-entry']);
        $this->addColumn('price', ['label' => __('Price'), 'class' => 'required-entry']);
        $this->addColumn('from_qty', [
            'label' => __('Tax'),
            'class' => $this->_getTaxRenderer()
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    protected function _prepareArrayRow(DataObject $row)
    {
        $options = [];
        $tax = $row->getTax();
        if ($tax !== null) {
            $options['option_' . $this->_getTaxRenderer()->calcOptionHash($tax)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }

    private function _getTaxRenderer(): TaxColumn
    {
        if (!$this->_taxRenderer) {
            $this->_taxRenderer = $this->getLayout()->createBlock(
                TaxColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->_taxRenderer;
    }
}