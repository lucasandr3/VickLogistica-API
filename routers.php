<?php
global $routes;
$routes = array();

/*
*   Rotas do APP 
*/

// rota de login
$routes['/auth'] = '/auth/signin';

// rota de dados gerais
$routes['/data'] = '/data';

// rota de frotas
$routes['/fleet'] = '/fleet';

// rota das frentes
$routes['/fronts'] = '/fronts';
// $routes['/fronts'] = '/fronts/changes';

// rota de motoristas
$routes['/drivers'] = '/drivers';

// rota de controle de viagem
$routes['/travel'] = '/travel';
$routes['/travel'] = '/travel/front_arrival';
$routes['/travel'] = '/travel/front_exit';
$routes['/travel'] = '/travel/balance_arrival';
$routes['/travel'] = '/travel/discharge';
$routes['/travel'] = '/travel/control_final';
$routes['/travel'] = '/travel/change_driver';

// rota de categorias
$routes['/waiting'] = '/waiting/start';
$routes['/waiting'] = '/waiting/final';

// rota de abastecimento
$routes['/diesel'] = '/diesel';

// rota de checklist
$routes['/checklist'] = '/checklist';

/*
*  Fim das rotas do app
*/


