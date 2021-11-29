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
$router->get("/clientes", "App:clients", "app.clients");
$router->get("/creditos", "App:Credits", "app.credits");
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
/*painel de controle*/
$router->group("api");
$router->get("/v1/getdategraph", 'Api:getDateGraph');
$router->get("/v1/getdatagraph/{min_date}/{max_date}", "Api:getDataGraph");

/*companies*/
$router->get("/v1/getcompanies", "Api:getCompanies");
$router->post("/v1/addcompany", "Api:addCompany", "api.addCompany");
$router->post("/v1/editcompany", "Api:editCompany", "api.editCompany");
$router->post("/v1/deletecompany/{id_company}", "Api:deleteCompany");

/*clients*/
$router->get("/v1/getclients", "Api:getClients");
$router->post("/v1/addclient", "Api:addClient", "api.addClient");
$router->post("/v1/editclient", "Api:editClient", "api.editClient");
$router->post("/v1/deleteclient/{id_client}", "Api:deleteClient");

/*credits*/
$router->get("/v1/getcredits", "Api:getCredits");

$router->group("ooops");
$router->get("/{errcode}", "App:errorPage");

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