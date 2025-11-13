<?php
session_start();

require_once __DIR__ . '/app/bootstrap.php';

$app = new Polinema\WebProfilLabSe\Core\App;

require_once __DIR__ . '/app/routes.php';

$app->run();