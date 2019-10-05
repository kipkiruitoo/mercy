<?php
?>
<!DOCTYPE html>

<html>
    <head>
        <title>SUPA SHOPA</title>
        <link rel="stylesheet" type="text/css" href="shopa.css">
    </head>
    <body>

      
        <form method="post" action="authenadmin.php">
            <div style="background-color:#A19595 ; color:white;padding:15px;">

                <fieldset>
                    <label>Email Address</label><br>
                    <input type="text" name="customer" id="User Name" required autofocus><br><br>
                    <label>Password</label><br>
                    <input type="Password" name="Password" id="Password" required ><br><br>

                </fieldset>
            </div>
            <div class="button">
                <button>SUBMIT</button>
            </div>
        </form>
             <p> Don't have an account? Please signup here</p><br>
             <a href="administratorsignup.php">SIGN UP</a>
    </body>
</html>