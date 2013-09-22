<?php

function draw(&$data)
{ //print_r($data);
    //print_r($_POST);
?>
    <title><?php echo $data[pageTitle]; ?></title>
    </head> 

    <body>
        <!-- this is where the login and logout label is placed -->
        <div class="top">
            <?php echo $data[nav_links]; ?>
        </div>

        <!-- important important pretty logo -->
        <div id="logo">
            <a href="index.php">
                <img src="resources/logotrans.png" height="175px" 
                alt="Simple Blog Logo"></img>
            </a>
        </div>

        <div class="center pad" id="newBlogEntry">
             <form name="addNewBlog" method="post" 
                    action="./index.php?c=blog&amp;view=viewPostedBlog">
                <label for="blogTitle">Blog Title:</label>
                <input type="text" id="blogTitle" name="blogTitle" 
                    placeholder="Enter the Title"/>
                <br><br>

                <label for="blogContent">Content:</label>
                <textarea id="blogContent" name="blogContent" rows="15" cols="70">
                </textarea>
                <br><br>

                <input type="submit" id="submit" name="submit" />
            </form>
        </div>

<?php
}
?>