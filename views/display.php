<?php

// SJSU Student
// Fall 2010
// Here we draw webpages. *doodledoodlesketchsketch* :)

function render($data)
{ //print_r($data);
?>

<title><?php echo $data[pageTitle]; ?></title>
</head>

<body>

    <div class="invisible">
        <a href="./" class="purplebox banner">
        Trivial Wiki</a></div>

    <ul class="nav_list">
        <?php echo $data[nav_links]; ?>
        </ul>

    <div id="container">

    <div id="places">
        <h2>Places to Go</h2>
        <ul><?php echo $data[places]; ?></ul></div>

    <div id="content">
        <h1><?php echo $data[title]; ?></h1>
        <pre><?php echo $data[content]; ?></pre>
        </div>
        
    </div> <!-- end container div -->
<?php
}
?>
