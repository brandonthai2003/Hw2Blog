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

        <div class="center pad" id="loginForm">
            <p id="warning">Wrong username or password. Please try again.</p>
            <form name="login" method="post" action="./index.php?c=login">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" 
                    placeholder="Enter your username"/>
                <br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" 
                    placeholder="Enter your password"/>
                <br><br>

                <input type="submit" id="submit" name="submit" />
            </form>
        </div>

<?php
}
?>
