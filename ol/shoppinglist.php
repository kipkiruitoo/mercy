<?php
?>
<!DOCTYPE html>

<html>
	<head>
		<title>SUPA SHOPA</title>
		<P>Please fill in shopping list</P>
		
	</head>
	<style>
			body{
				text-align: center;
				background-image: url("list.PNG");
				background-repeat: no-repeat;
  				background-size: 1300px 700px;
				font-family: "sans-serif", arial;
				}
				button {
  				background-color: #2980B9; /* Green */
  				border: none;
  				color: white;
  				padding: 15px 32px;
  				text-align: center;
  				text-decoration: none;
  				display: inline-block;
  				font-size: 16px;
				}

	</style>
	<body>
			<form action="getshoppinglist.php" method="get">
			<div id="links">
			  	<button> <div class="link""><a href="home.php">HOME</a></div></button>
		    	<button> <div class="link" id="current-page"> <a href="shoppinglist.php">SHOPPING</a></div></button>
		    	<button> <div class="link""><a href="payment.php">MAKE PAYMENT</a></div><br>
				</button></div>
				<div style="background-color:#A19595 ; color:white;padding:15px;">

					<fieldset>
						<label>ShopperID</label><br>
						<input type="varchar" name="shopperID" id="ShopperId" required autofocus><br><br>
						<label>Shopper First Name</label><br>
						<input type="varchar" name="shopperID" id="ShopperId" required autofocus><br><br>
						<label>Shopper Last Name</label><br>
						<input type="varchar" name="shopperID" id="ShopperId" required autofocus><br><br>
						<label>Supermarket</label><br>
						<select name="pick">
   							 <option value="Naivas">Naivas</option>
    						 <option value="Tuskys">Tuskys</option>
    						 <option value="Nakumatt">Nakumatt</option>
                             <option value="Chandarana">Chandarana</option>
                             <option value="Carrefour">Carrefour</option>
                             <option value="Choppies">Choppies</option>
                             <option value="Uchumi">Uchumi</option>
                        </select><br><br>
                        
						<label>order </label><br>
						<input type="varchar" name="order" id="orders" required autofocus><br><br>
						<select multiple name = "list">
  							<option value="Cookingoil">Cooking Oil</option>
  							<option value="Rice">Rice</option>
  							<option value="Maize flour">Maize flour</option>
  							<option value="Wheat flour">Wheat flour</option>
  							<option value="Blueband">Blueband</option>
  							<option value="Tissuepaper">Tissue Paper</option>
  							<option value="Salt">Salt</option>
  							<option value="Detergent">Detergent</option>
  							<option value="Bathingsoap">Bathing Soap</option>
						</select><br><br>
						
						
						                       

					</fieldset>
				</div>
			</form>
		</body>
</html>