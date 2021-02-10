<?php 

// Lista branca de rotas

use System\Application;

$app = Application::getInstance();

$app->route->add('/', 'Home');

// Login
$app->route->add('/login', 'Login');
$app->route->add('/login/submit', 'Login@submit', 'POST');

// layout
$app->share('Layout', function($app) {
	return $app->load->controller('Partials/Layout');
});

// layout User
$app->share('LayoutUser', function($app) {
	return $app->load->controller('Partials/LayoutUser');
});

// Layout PS
$app->share('LayoutPS', function($app) {
	return $app->load->controller('Partials/LayoutPS');
});

// layout GP
$app->share('LayoutGP', function($app) {
	return $app->load->controller('Partials/LayoutGP');
});

// Dashboard
$app->route->add('/dashboard', 'Dashboard');

// Pessoas Físicas
$app->route->add('/pessoa-fisica', 'PessoaFisica');


// $app->route->add('/users/add', 'User@add', 'POST');
// $app->route->add('/users/submit', 'User@submit', 'POST');
// $app->route->add('/users/edit/:id', 'User@edit', 'POST');
// $app->route->add('/users/save/:id', 'User@save', 'POST');


// Logout
$app->route->add('/logout', 'Logout');

// Não encontradas
$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');
