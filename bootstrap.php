<?php
/**
 * AVOLUTIONS
 *
 * Just another open source PHP framework.
 *
 * @copyright   Copyright (c) 2019 - 2021 AVOLUTIONS
 * @license     MIT License (https://avolutions.org/license)
 * @link        https://avolutions.org
 */

use Avolutions\Core\Application;
use Avolutions\Config\Config;
use Avolutions\Database\Database;
use Avolutions\Util\Translation;

/**
 * Get start time
 */
define('START_TIME', microtime(true));

/**
 * Register the Autoloader
 */
require __DIR__.'/vendor/autoload.php';

/**
 * Set error handler
 */
$ErrorHandler = new Avolutions\Core\ErrorHandler();
set_error_handler([$ErrorHandler, 'handleError']);
set_exception_handler([$ErrorHandler, 'handleException']);

/**
 * Initialize application
 */
$Application = Application::getInstance();
$Application->initialize(__DIR__);

/**
 * Initialize configuration
 */
$Config = Config::getInstance();
$Config->initialize();

/**
 * Initialize translation
 */
$Translation = Translation::getInstance();
$Translation->initialize();

/**
 * Migrate the Database
 */
if (Config::get('database/migrateOnAppStart')) {
    Database::migrate();
}