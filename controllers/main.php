<?php

// SJSU Student
// Fall 2010
// Main controller

require_once("./models/entry.php");
require_once("./models/authenticate.php");

// ----------[entry function]----------

function mainEntry($entry, $view)
{
    global $PARSE_MODE_ON;

    //clear the session, signing out.
    if (strcmp($view, "logout") == 0)
        $_SESSION = array(); 
    
    // if you are not signed in, then you go to the not logged in page
    $is_signed_in = isSignedIn();
    if (!$is_signed_in)
        $view = "notloggedin"; 
    
    // do we need to create a page?
    if ($is_signed_in && (strcmp($view, "new") == 0))
    {/****************DANGER*******/
        $entry = $_GET['p'];
        createNewPage($entry); // this should alter the page #
        $view = "loggedin";
    }
    
    // now check to make sure we are at a real page!
    if (!fileExists($entry))
    {
        $entry = "1";
        $view = "notloggedin";
    }
    
    // check if user is in edit mode:
    $is_editing = (strcmp($view, "edit") == 0);
    
    // read from file & generate links:
    $fileData   = getPageContent($entry);
    if ($PARSE_MODE_ON)
        $placesToGo = updatePlaces($fileData["content"], $entry);
    else $placesToGo = $fileData;
    
    // set the cool & awe-inspiring data variable:
    $data = array();
    $data["entry"]     = $entry;
    $data["nav_links"] = getNaviLinks($is_signed_in, $entry);
    $data["title"]     = $fileData["title"];
    $data["content"]   = $fileData["content"];
    $data["places"]    = getPlacesToGo($placesToGo); // formatting
    $data["places_hd"] = getPlacesToGoAsHiddenInputs($placesToGo); // ditto
    $data["pageTitle"] = $data["title"];
    if (strcmp($view, "edit") == 0)
        $data["pageTitle"] = $data["pageTitle"]." [edit mode]";
    
    if ((include_once("./views/".$view.".php")) != 1) // 1: success
        require_once("./views/notloggedin.php"); // default
    
    draw($data);
}

// ----------[helper functions]----------

function getNaviLinks($isLoggedIn, $entry)
{
    if (!$isLoggedIn)
        return "<a id=\"login\" href=\"./index.php?c=login&amp;e=".$entry
            ."&amp;view=login\">Logon</a>";
//"<li><a href=\"./index.php?c=main&amp;p=".$entry."&amp;view=new\">New</a></li>  "
    $toReturn = "<a id=\"logout\" href=\"./index.php?c=main&amp;e=".$entry
            ."&amp;view=logout\">Log Out</a>".
            "<a id=\"newEntry\" href=\"./index.php?c=main&amp;e=".$entry
            ."&amp;view=blog\">Add New Entry</a>";

   /* if (!$isEditing) // don't show "edit" if already in edit mode
        return "<li><a href=\"./index.php?c=main&amp;p=".$entry
            ."&amp;view=edit\">Edit</a></li>  ".$toReturn;
    return "<li><a href=\"./index.php?c=main&amp;p=".$entry
            ."&amp;view=display\">Cancel</a></li>  ".$toReturn;*/

    return $toReturn;
}

function getPlacesToGo($places) // updates places if necessary
{
    $toReturn = "";
    
    for ($i = 1; array_key_exists("link".$i."a", $places); $i++)
    {
        $key1 = "link".$i."a";
        $key2 = "link".$i."b";
        $toReturn = $toReturn . "<li><a href=\""
            .$places[$key1]."\">"
            .$places[$key2]."</a></li>";
    }
    
    if ($i == 1) // default link if nothing related is found
        return "<li><a href=\"./index.php\">Front Page</a></li>";
    
    return $toReturn;
}

function getPlacesToGoAsHiddenInputs($places) // call getPlaces() first!
{
    // it is important to have these links stored as hidden form
    // inputs only if $PARSE_MODE_ON is false.  if it is false,
    // these get used.  otherwise, links are generated from
    // whatever is typed into the content box (more fun that way)

    $toReturn = "";

    for ($i = 1; array_key_exists("link".$i."a", $places); $i++)
    {
        $key1 = "link".$i."a";
        $key2 = "link".$i."b";
        $toReturn = $toReturn."<input type=\"hidden\" name=\""
            .$key1."\" value=\"".$places[$key1]."\" />"
            ."<input type=\"hidden\" name=\""
            .$key2."\" value=\"".$places[$key2]."\" />";
    }
    
    return $toReturn;
}

function updatePlaces($content, $entry)
{
    $places = array();
    global $PARSE_MODE_ON;
    
    if ($PARSE_MODE_ON)
    {
        $articles = getArticleList(); // talk to pages.php again
        $haystack = strtolower($content);
        
        for ($i = 1, $j=1; array_key_exists($i, $articles); $i++)
        {
            if ($entry == $i)
                continue; // don't link to self, silly! ^^;
            
            if (0 < substr_count($haystack, strtolower($articles[$i])))
            {
                $places["link".$j."a"] = "./index.php?c=main&amp;p="
                    .$i."&amp;v=display";
                $places["link".$j."b"] = $articles[$i];
                $j++;
            }
        }
    }
    
    return $places;
}

?>
