<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = true;

$db['default'] = array(
    'dsn' => '',
    'hostname' => 'localhost',
    'username' => ENVIRONMENT !== 'production' ? 'root' : 'root',
    'password' => ENVIRONMENT !== 'production' ? '' : 'charis838',
    'database' => ENVIRONMENT !== 'production' ? 'ci_wmi' : 'wmi',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => false,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => false,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => false,
    'compress' => false,
    'stricton' => false,
    'failover' => array(),
    'save_queries' => true,
);