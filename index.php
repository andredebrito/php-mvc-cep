<?php

ob_start();

/**
 * autoload
 */
require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */
use CoffeeCode\Router\Router;

//Starts the main session:
if (!session_id()) {
    session_start();
}

//Starts the router:
$route = new Router(url(), ":");

/**
 * APP ROUTES
 */
$route->namespace("Source\Controllers");

//home
$route->group(null);
$route->get("/", "HomeController:index");
$route->post("/", "HomeController:request");


/**
 * ERROR ROUTES
 */
$route->namespace("Source\Controllers");
$route->group("/ops");
$route->get("/{errcode}", "ErrorController:error");

/**
 * ROUTE EXEC
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
