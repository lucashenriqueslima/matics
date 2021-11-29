
<?php

define("SITE",[
"name"=>"Matics² | ",
"desc"=>"desc qualquer",
"domain"=>"",
"locale"=>"pt_BR",
"root"=>"http://localhost:888/matics2",
"route"=>"Source\Controllers\\",
"folder" => "/".explode("/" ,$_SERVER["REQUEST_URI"])[1]

]);

define("VIEWSPATH", dirname(__DIR__, 1)."/views/themes",); 

define("DATABASE", [
    "host" => "localhost",
    "port" => "3306",
    "name" => "matics2",
    "username" => "root",
    "passwd" => "",
]);
