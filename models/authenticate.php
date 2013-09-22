<?php

//pat is the blogger. The system has only one user.
$good_user = array("pat" => "secret");

//Let's authenticate the people who are signing in
function authenticate($username, $password)
{
    global $good_user; 

    if(array_key_exists($username, $good_user) &&
        (strcmp($password, $good_user[$username]) == 0))
    {
        return true;
    }
    return false;
}

//checks if the person is signed in
function isSignedIn()
{
    if(isset($_SESSION["authorized"]) && $_SESSION["authorized"])
    {
        return true;
    }
    return false;
}

?>