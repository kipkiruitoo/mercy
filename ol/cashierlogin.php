<?php
?>
<!DOCTYPE html>

<html>
    <head>
        <title>AMEKEN TRANSPORT SYSTEM</title>
        <link rel="stylesheet" type="text/css" href="ameken.css">
        <style>
            h1, h2, h3, h4, h5 {
                color: black;
            }
            body{
                text-align: center;
                background-image: url("img9.jpg") ;
                font-family: "sans-serif", arial;

            }
            a {
                color: #FFFFFF;
            }

            #contact {
                background-color: #A19595;
            }

            ul {
                list-style-type: none;
            }

        </style>

    </head>
    <body>
        <div id="contact">
      
            <form method="post" action="authencashier.php">
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
            <a href="cashiersignup.php">SIGN UP</a>


        </div>
    </body>
</html>