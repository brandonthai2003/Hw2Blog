<?php session_start();
    require_once("./config/wiki_config.php");
?>
    
<!-- html header -->
        
<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="./css/main.css" type="text/css" />
    <meta name="robots" content="noindex,nofollow" />

<!-- this is all the header. The view will contain the rest -->

<?php
// What are we showing based on the query string?
$default_ctrl = "main";
$default_view = "notloggedin";
$default_entry = "mostrecent";


if (array_key_exists("c", $_REQUEST))
{
    $controller = strtolower($_REQUEST["c"]);
}
else 
{
    $controller = $default_ctrl;
}

if (array_key_exists("view", $_REQUEST))
    $view = strtolower($_REQUEST["view"]);
else $view = $default_view;

if (array_key_exists("e", $_REQUEST))
    $entry = $_REQUEST["e"];
else $entry = $default_entry;

//we need the controllers

require_once("./controllers/main.php");
require_once("./controllers/login.php");
require_once("./controllers/blog.php");

// talk to the controller

switch($controller)
{
    case "blog":
        blogEntry($entry, $view);
        break;
    case "login":
        signinEntry($entry, $view);
        break;
    case "main":
    default: 
        mainEntry($entry, $view);
        break;
}

/*
print_r($_REQUEST);
print_r($_SESSION);
print_r($_POST);
print_r($_GET);*/

?> 

<!-- here's the footer -->
</body>
</html>
