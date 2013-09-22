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

        <h2 class="center"> Your posted blog </h2>
        <div class = "center pad" id="blogContent">
            <p id="title"> <?php echo $data['blogTitle'] ?> </p>
            <p> <?php echo $data['blogContent'] ?> </p>
        </div>

        <div id="goBack" class="center pad">
            <a href="index.php">Go Back Home</a>
        </div>

<?php
}
?>
