<?php

// SJSU Student
// Fall 2010
// Here we handle the read/write of wiki pages to/from files.

$linebreak = "\r\n";
$file_pre  = "./pages/p_";
$file_post = ".txt";

function saveBlogtoFile()
{
    $folderName = time();
    mkdir("./entries/$folderName");
    file_put_contents("./entries/$folderName/blog.txt", $_POST["blogTitle"].
            "\n".$_POST["blogContent"]);
    // $fileHandle = fopen("./entries/$folderName/blog.txt", "a");
    // fwrite($fileHandle, $_POST["blogContent"]);
    // fclose($fileHandle);
}


function createNewPage(&$entry)
{
    global $file_pre;
    global $file_post;
    
    for ($i = 1; file_exists($file_pre.$i.$file_post); $i++)
        /* empty statement */;

    $fileData = getPageContent($entry);

    $_POST["title"] = "New Page";
    $_POST["content"] = "Content goes here.  Mind your step.";

    $fileData["link".$i."a"] = './index.php?c=main&p='.$i.'&v=display';
    $fileData["link".$i."b"] = $_POST["title"];
    updateContentAndLinks($entry, $fileData, true);

    $entry = $i;

    updateContent($entry);
}

function fileExists($entry)
{
    global $file_pre;
    global $file_post;
    return file_exists($file_pre.$entry.$file_post);
}

function getArticleList()
{
    $articles;
    global $file_pre;
    global $file_post;
    
    for ($i = 1; file_exists($file_pre.$i.$file_post); $i++)
    {
        $fileHandle = fopen($file_pre.$i.$file_post, "r");
        if (flock($fileHandle, LOCK_SH))
        {
            $articles[$i] = trim(fgets($fileHandle, 500));
            flock($fileHandle, LOCK_UN); // get title & run!
        }
        fclose($fileHandle);
          
    }
    
    return $articles;
}

function getPageContent($entry)
{
    global $file_pre;
    global $file_post;
    global $linebreak;
    
    $file = $file_pre.$entry.$file_post;
    $fileData;
    $fileHandle = fopen($file, "r");
    
    if (flock($fileHandle, LOCK_SH))
    {
        $fileData['title'] = trim(fgets($fileHandle, 500));
        
        for ($i = 1; $i < 101; $i++)
        {
            $line1 = trim(fgets($fileHandle, 500));
                if (strcmp($line1, "===") == 0)
                    break;
            $line2 = trim(fgets($fileHandle, 500));
                if (strcmp($line2, "===") == 0)
                    break;
            $fileData["link".$i."a"] = $line1;
            $fileData["link".$i."b"] = $line2;
        }
        
        while (!feof($fileHandle))
            $fileData['content'] = $fileData['content']
                . fgets($fileHandle, 64000);
        
        flock($fileHandle, LOCK_UN); // lock release
    }
    
    fclose($fileHandle);
    return $fileData;
}

function updateContent($entry)
{
    global $file_pre;
    global $file_post;
    global $linebreak;
    
    $file = $file_pre.$entry.$file_post;
    $fileHandle = fopen($file, "w");
    
    if (flock($fileHandle, LOCK_EX))
    {
        fwrite($fileHandle, $_POST["title"]);
        fwrite($fileHandle, $linebreak);
        
        for ($i = 1; array_key_exists("link".$i."a", $_POST); $i++)
        {
            fwrite($fileHandle, $_POST["link".$i."a"]);
            fwrite($fileHandle, $linebreak);
            fwrite($fileHandle, $_POST["link".$i."b"]);
            fwrite($fileHandle, $linebreak);
        }
        
        fwrite($fileHandle, "===");
        fwrite($fileHandle, $linebreak);
        fwrite($fileHandle, $_POST["content"]);
        flock($fileHandle, LOCK_UN); // lock release
    }
    
    fclose($fileHandle);
}

function updateContentAndLinks($entry, $fileData, $useFileData = false)
{
    /* useFileData flag says whether to assume title and content should be from
       the file or not (i.e. POST'd)) */
    global $file_pre;
    global $file_post;
    global $linebreak;
    
    $file = $file_pre.$entry.$file_post;
    $fileHandle = fopen($file, "w");
    
    if (flock($fileHandle, LOCK_EX))
    {
        $title = ($useFileData) ? $fileData["title"] : $_POST["title"];
        $content = ($useFileData) ? $fileData["content"] : $_POST["content"];
        unset($fileData["title"]);
        unset($fileData["content"]);

        fwrite($fileHandle, $title);
        fwrite($fileHandle, $linebreak);

        foreach($fileData as $linkName => $linkData) {
            fwrite($fileHandle, $linkData);
            fwrite($fileHandle, $linebreak);
        }
        
        fwrite($fileHandle, "===");
        fwrite($fileHandle, $linebreak);
        fwrite($fileHandle, $content);
        flock($fileHandle, LOCK_UN); // lock release
    }
    
    fclose($fileHandle);
}

?>
     