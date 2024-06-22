<?php
require_once('vendor/smarty/smarty/libs/Smarty.class.php');

use Smarty\Smarty;
$smarty = new Smarty();

$smarty->setTemplateDir([
    __DIR__ . '/app/views/templates',
    __DIR__ . '/app/views/templates/auth',
]);
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');
$smarty->setConfigDir(__DIR__ . '/configs');


