<?php

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;
session_start();


$router = new Router(site('root')); 

$router->namespace("Source\Controllers");

$router->group(null);
$router->get("/",  "Web:login");

/**
 * App
 */
$router->group("me");
$router->get("", "App:home", "app.home");
$router->get("/empresas", "App:companies", "app.companies");
$router->get("/painel-de-controle", "App:dashboard", "app.dashboard");
$router->get("/cadastrar-empresa", "App:registerCompany", "app.registerCompany");
$router->get("/logoff", "App:logoff", "app.logoff");

/**
 * Auth Web
 */
$router->group("auth");
$router->post("/login", "Auth:login");
$router->post("/reset", "Auth:msg");






/**
 * Api
 */
$router->group("api");
$router->get("/v1/getdategraph", 'Api:getDateGraph');
$router->get("/v1/getdatagraph/{min_date}/{max_date}", "Api:getDataGraph");
$router->get("/v1/getcompanies", "Api:getCompanies");
$router->get("/v1/getcompanies/{keyword}", "Api:getCompanies");

$router->group("ooops");
$router->get("/{errcode}", function ($data){
    echo "<h2>Erro ao Carregar a página</h2>";
});

$router->dispatch();

if($router->error()){
    $router->redirect("/ooops/{$router->error()}");
}












// require __DIR__."/vendor/autoload.php";

// use Source\Router;

// $router = new Router;

// /**
//  * Web
//  */




// /*
// $router->notFound(function(){
//     $title = "TITULO";
//     require_once __DIR__."/views/themes/404.php";  
// });
// */


// $router->run();