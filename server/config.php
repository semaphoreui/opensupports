<?php
$env['MYSQL_HOST']     = getenv('MYSQL_HOST');
$env['MYSQL_PORT']     = getenv('MYSQL_PORT');
$env['MYSQL_USER']     = getenv('MYSQL_USER');
$env['MYSQL_PASSWORD'] = getenv('MYSQL_PASSWORD');
$env['MYSQL_DATABASE'] = getenv('MYSQL_DATABASE');

$env['SESSION_PROVIDER_URL'] = getenv('SESSION_PROVIDER_URL');

$mysql_host       = ($env['MYSQL_HOST'])     ? $env['MYSQL_HOST'] : 'localhost';
$mysql_port       = ($env['MYSQL_PORT'])     ? $env['MYSQL_PORT'] : '3306';
$mysql_user       = ($env['MYSQL_USER'])     ? $env['MYSQL_USER'] : 'root';
$mysql_password   = ($env['MYSQL_PASSWORD']) ? $env['MYSQL_PASSWORD'] : '';
$mysql_database   = ($env['MYSQL_DATABASE']) ? $env['MYSQL_DATABASE'] : 'development';

$session_provider_url   = ($env['SESSION_PROVIDER_URL']) ? $env['SESSION_PROVIDER_URL'] : 'development';

define('MYSQL_HOST', $mysql_host);
define('MYSQL_PORT', $mysql_port);
define('MYSQL_USER', $mysql_user);
define('MYSQL_PASSWORD', $mysql_password);
define('MYSQL_DATABASE', $mysql_database);
define('SESSION_PROVIDER_URL', $session_provider_url);

error_reporting(E_ALL ^ E_DEPRECATED);
