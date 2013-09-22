<?php

require_once("./models/entry.php");

function blogEntry(&$entry, &$view)
{
    //check if blogs are posted. 
    if(isset($_POST["blogTitle"]) && isset($_POST["blogContent"]))
    {
        saveBlogtoFile(); //save the blog from entry.php
        $data["blogTitle"] = $_POST["blogTitle"];
        $data["blogContent"] = $_POST["blogContent"];

        //clear the post content after saving. We don't need it anymore.
        $_POST["blogEntry"] = Array();
        $_POST["blogContent"] = Array();
    }
    require_once("./views/".$view.".php");
    
    $data["pageTitle"] = "This Kewl BLOG!";
    
    draw($data);
}

?>

