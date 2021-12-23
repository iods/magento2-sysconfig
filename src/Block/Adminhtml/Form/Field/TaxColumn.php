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

use Magento\Config\Model\Config\Source\Yesno;
use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Element\Html\Select;

class TaxColumn extends Select
{
    private Yesno $_yesno;

    public function __construct(
        Context $context,
        Yesno $yesno,
        array $data = []
    ) {
        $this->_yesno = $yesno;
        parent::__construct(
            $context,
            $data
        );
    }

    // sets "name" for the select attribute
    public function setInputName(string $value): Select
    {
        return $this->setNameInLayout($value);
    }

    // sets the id
    public function setInputId(string $value): Select
    {
        return $this->setId($value);
    }

    // returns the select input
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->_yesno->toOptionArray());
        }
        return parent::_toHtml();
    }
}