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
use Magento\Store\Model\ScopeInterface;

/**
 * Class FrontendModel
 * @package Iods\Configs\Model\System\Config
 */
class FrontendModel
{
    /** @var array|null */
    private ?array $_data;

    /** @var ScopeConfigInterface */
    private ScopeConfigInterface $_scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param array|null $data
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ?array $data = []
    ) {
        $this->_data = $data;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Description for the getColor() function.
     * @return string
     */
    public function getColor(): string
    {
        $configPath = $this->_data['color'] ?? '';
        if (!$configPath) {
            return '';
        }
        return (string) $this->_scopeConfig->getValue(
            $configPath,
            ScopeInterface::SCOPE_STORE
        );
    }
}