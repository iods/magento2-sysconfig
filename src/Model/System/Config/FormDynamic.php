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

namespace Iods\Configs\Model\System\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\ScopeInterface;

/**
 * Class FormDynamic
 * @package Iods\Configs\Model\System\Config
 */
class FormDynamic
{
    /** @var array */
    private array $_data = [];

    /** @var Json */
    private Json $_json;

    /** @var ScopeConfigInterface */
    private ScopeConfigInterface $_scopeConfig;

    /**
     * @param Json $json
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Json $json,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->_data = $data;
        $this->_json = $json;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Description of Function getFormValues()
     * @return array
     */
    public function getFormValues(): array
    {
        $configPath = $this->_data['values'];
        if (!$configPath) {
            return [];
        }
        return $this->_json->unserialize(
            $this->_scopeConfig->getValue($configPath, ScopeInterface::SCOPE_STORE)
        );
    }
}