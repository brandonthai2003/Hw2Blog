<?php

function draw($data)
{
?>
    <title><?php echo $data[pageTitle]; ?></title>
    </head> 

    <div class="center pad" id="comment">
         <form name="login" method="post" action="./index.php?c=login">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" 
                placeholder="Enter your name"/>
            <br><br>

            <label for="commentField">Comment:</label>
            <textarea id="commentField" name="comment" rows="8" cols="70"></textarea>
            <br><br>

            <input type="submit" id="submit" name="submit" />
        </form>
    </div>

<?php
}
?>