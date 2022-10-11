<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use LearnPhpMvc\APP\Router;
use LearnPhpMvc\controller\CompanyController;
use LearnPhpMvc\controller\HomeController;
use LearnPhpMvc\controller\ProductController;
use LearnPhpMvc\controller\LamarController;



Router::add('GET', '/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)', ProductController::class, 'categories');

Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/hello', HomeController::class, 'hello', [AuthMiddleware::class]);
Router::add('GET', '/world', HomeController::class, 'world', [AuthMiddleware::class]);
Router::add('GET', '/about', HomeController::class, 'about');

Router::add('POST', '/company/search', CompanyController::class, 'search');
Router::add('GET', '/company', CompanyController::class, 'bestCompany');
Router::add('GET', '/formlamar', LamarController::class, 'formLamar');

Router::run();