<?php

// ----------[sign-in functions]----------

function setView(&$view)
{
    //if users are already authorized, then login is success
    if (isset($_SESSION["authorized"]) && $_SESSION["authorized"])
        $view = "loginSuccess"; 
    else if (!isset($_POST["username"]))
        $view = "login";
    //if authenticated, we go to login success and set the session to authorized.
    else if (authenticate($_POST["username"], $_POST["password"]))
    {
        $view = "loginSuccess";
        $_SESSION["user"] = $_POST["username"];
        $_SESSION["authorized"] = true;
    }
    else //if login fail, then it fails! 
        $view = "loginFail";
}

// ----------[entry function]----------

function signinEntry(&$entry, &$view)
{
    setView($view);
    require_once("./views/".$view.".php");
    
    $data["pageTitle"] = "This Kewl BLOG!";
    
    draw($data);
}

?>

