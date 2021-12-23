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

namespace Iods\Configs\ViewModel;

use Iods\Configs\Model\System\Config\FormDynamic;
use Iods\Configs\Model\System\Config\FrontendModel;
use Iods\Configs\Model\System\Config\General;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ConfigPool implements ArgumentInterface
{
    private FormDynamic $_formDynamic;

    private FrontendModel $_frontendModel;

    private General $_general;

    public function __construct(
        FormDynamic $formDynamic,
        FrontendModel $frontendModel,
        General $general
    ) {
        $this->_formDynamic = $formDynamic;
        $this->_frontendModel = $frontendModel;
        $this->_general = $general;
    }

    /**
     * Return the Dynamic Form Configurations.
     * @return FormDynamic
     */
    public function getFormDynamicConfig(): FormDynamic
    {
        return $this->_formDynamic;
    }

    /**
     * Returns the Frontend Model Configurations.
     * @return FrontendModel
     */
    public function getFrontendModelConfig(): FrontendModel
    {
        return $this->_frontendModel;
    }

    /**
     * Returns General module configurations.
     * @return General
     */
    public function getGeneralConfig(): General
    {
        return $this->_general;
    }
}