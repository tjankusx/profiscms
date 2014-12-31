<?php
use \Profis\CMS\App;

include 'core/autoload.php';

$config = include('app/config/local.php');
$app = new App($config);
$app->run();
