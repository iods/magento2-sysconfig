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
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class General
 * @package Iods\Configs\Model\System\Config
 */
class General
{
    /** @var string[]|null */
    private array $_data;

    /** @var EncryptorInterface */
    private EncryptorInterface $_encryptor;

    /** @var ScopeConfigInterface */
    private ScopeConfigInterface $_scopeConfig;

    /**
     * @param EncryptorInterface $encryptor
     * @param ScopeConfigInterface $scopeConfig
     * @param string[]|null $data
     */
    public function __construct(
        EncryptorInterface $encryptor,
        ScopeConfigInterface $scopeConfig,
        ?array $data = []
    ) {
        $this->_data = $data;
        $this->_encryptor = $encryptor;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Returns the API key for the Dark Society Cloud from Config Path.
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->_encryptor->decrypt(
            $this->_getValue('api_key')
        );
    }

    /**
     * Returns the API url for the Dark Society Cloud endpoint.
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->_encryptor->decrypt(
            $this->_getValue('api_url')
        );
    }

    /**
     * Returns the available countries for the Dark Society product API.
     * @return string
     */
    public function getCountries(): string
    {
        return $this->_getValue('countries');
    }

    /**
     * Returns the email address used for the Dark Society API login.
     * @return string
     */
    public function getEmail(): string
    {
        return $this->_getValue('email');
    }

    /**
     * Description of the getTime() function.
     * @return string
     */
    public function getTime(): string
    {
        return $this->_getValue('time');
    }

    /**
     * Returns whether the _ is enabled or not.
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (bool) $this->_getValue('enabled');
    }

    /**
     * Description of _getValue function.
     * @param string $value
     * @return string
     */
    private function _getValue(string $value): string
    {
        $configPath = $this->_data[$value] ?? '';
        if (!$configPath) {
            return '';
        }

        return (string) $this->_scopeConfig->getValue(
            $configPath,
            ScopeInterface::SCOPE_STORE
        );
    }
}