<?php

function draw($data)
{ //print_r($data);
?>

<title><?php echo $data[pageTitle]; ?></title>
</head>

<body>

    <div id="logo">
        <a href="index.php">
            <img src="resources/logotrans.png" height="175px" 
            alt="Simple Blog Logo"></img>
        </a>
    </div>
        
    <div class="center">
        <p id="title">Welcome, <?php echo $_SESSION["user"] ?>!</p>
    </div>

    <br><br>

    <div id="goBack" class="center pad">
        <a href="index.php">Go Back Home</a>
    </div>
<?php
}
?>
