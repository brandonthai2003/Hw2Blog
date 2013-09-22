<?php


function draw($data)
{ //print_r($data);
?>

    <!-- title of the pages are different -->
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

        <!-- recent blog post is posted here -->
        <div id="recentBlog" class="pad">
            <p id="title">Most Recent Blog Entry</p>

            <div id="entryList" class="right pad">
              <p id ="title">Blog List</p>
            </div>
        </div>
<?php
}
?>
