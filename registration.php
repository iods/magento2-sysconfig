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

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Iods_Configs',
    __DIR__
);
