<?php
session_start();

$controller = $_GET['c'] ?? 'produto';
$action = $_GET['a'] ?? 'index';

$controllerName = ucfirst($controller).'Controller';
require_once "controller/$controllerName.php";

$c = new $controllerName();
$c->$action();
