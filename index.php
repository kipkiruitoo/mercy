<?php 
include('dbconnect.php');

$sql = 'Select * from supermarket';

if (mysqli_query($conn, $sql)) {#


$result = mysqli_query($conn, $sql);

	
	 
}else{

	echo 'There was a problem' . mysqli_error($conn);
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Supashopa</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script type="application/x-javascript">
      addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
      	function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- //for-mobile-apps -->
    <link
      href="admin/css/bootstrap.css"
      rel="stylesheet"
      type="text/css"
      media="all"
    />
    <link
      href="admin/css/style.css"
      rel="stylesheet"
      type="text/css"
      media="all"
    />
    <!-- font-awesome icons -->
    <link
      href="admin/css/font-awesome.css"
      rel="stylesheet"
      type="text/css"
      media="all"
    />
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="admin/js/jquery-1.11.1.min.js"></script>
    <!-- //js -->
    <link
      href="//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic"
      rel="stylesheet"
      type="text/css"
    />
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="admin/js/move-top.js"></script>
    <script type="text/javascript" src="admin/js/easing.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $(".scroll").click(function(event) {
          event.preventDefault();
          $("html,body").animate(
            { scrollTop: $(this.hash).offset().top },
            1000
          );
        });
      });
    </script>
    <!-- start-smoth-scrolling -->
  </head>

  <body>
    <!-- header -->
    <div class="agileits_header">
      <div class="w3l_search">
        <form action="#" method="post">
          <input
            type="text"
            name="Product"
            value="Search a product..."
            onfocus="this.value = '';"
            onblur="if (this.value == '') {this.value = 'Search a product...';}"
            required=""
          />
          <input type="submit" value=" " />
        </form>
      </div>
      <div class="product_list_header">
        <form action="#" method="post" class="last">
          <fieldset>
            <input type="hidden" name="cmd" value="_cart" />
            <input type="hidden" name="display" value="1" />
            <input
              type="submit"
              name="submit"
              value="View your cart"
              class="button"
            />
          </fieldset>
        </form>
      </div>
      <div class="w3l_header_right">
        <ul>
          <li class="dropdown profile_details_drop">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
              ><i class="fa fa-user" aria-hidden="true"></i
              ><span class="caret"></span
            ></a>
            <div class="mega-dropdown-menu">
              <div class="w3ls_vegetables">
                <ul class="dropdown-menu drp-mnu">
                  <li><a href="login.html">Login</a></li>
                  <li><a href="login.html">Sign Up</a></li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="w3l_header_right1">
        <h2><a href="mail.html">Contact Us</a></h2>
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- script-for sticky-nav -->
    <script>
      $(document).ready(function() {
        var navoffeset = $(".agileits_header").offset().top;
        $(window).scroll(function() {
          var scrollpos = $(window).scrollTop();
          if (scrollpos >= navoffeset) {
            $(".agileits_header").addClass("fixed");
          } else {
            $(".agileits_header").removeClass("fixed");
          }
        });
      });
    </script>
    <!-- //script-for sticky-nav -->
    <div class="logo_products">
      <div class="container">
        <div class="w3ls_logo_products_left">
          <h1>
            <a href="index.php"><span>Super</span> Shopa</a>
          </h1>
        </div>
        <div class="w3ls_logo_products_left1">
          <ul class="special_items">
            <li><a href="about.html">About Us</a><i>/</i></li>
          </ul>
        </div>
        <div class="w3ls_logo_products_left1">
          <ul class="phone_email">
            <li><i class="fa fa-phone" aria-hidden="true"></i>0798326467</li>
            <li>
              <i class="fa fa-envelope-o" aria-hidden="true"></i
              ><a href="mailto:mercy.titus@strathmore.edu"
                >mercy.titus@strathmore.edu</a
              >
            </li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <!-- //header -->
    <div class="container">
      <div class="well">
        <?php while($row = mysqli_fetch_array($result)) {?>
        <div class="card">
          <div class="card-body">
            <a href="./aftermarket.php?sup=<?php echo $row['supermarketID'] ?>">
              <img
                src="./admin/files/<?php echo $row['logo'] ?>"
                class="card-img-top"
                alt="..."
                width="300px"
                height="150px"
              />
            </a>

            <h1 class="card-title"><?php echo $row['name'] ?></h1>
            <p class="card-text"><?php echo $row['location'] ?></p>
          </div>
        </div>

        <?php }?>
      </div>
    </div>

    <script src="admin/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        $(".dropdown").hover(
          function() {
            $(".dropdown-menu", this)
              .stop(true, true)
              .slideDown("fast");
            $(this).toggleClass("open");
          },
          function() {
            $(".dropdown-menu", this)
              .stop(true, true)
              .slideUp("fast");
            $(this).toggleClass("open");
          }
        );
      });
    </script>
    <!-- here stars scrolling icon -->
    <script type="text/javascript">
      $(document).ready(function() {
        /*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/

        $().UItoTop({ easingType: "easeOutQuart" });
      });
    </script>
    <!-- //here ends scrolling icon -->
    <script src="admin/js//minicart.js"></script>
    <script>
      paypal.minicart.render();

      paypal.minicart.cart.on("checkout", function(evt) {
        var items = this.items(),
          len = items.length,
          total = 0,
          i;

        // Count the number of each item in the cart
        for (i = 0; i < len; i++) {
          total += items[i].get("quantity");
        }

        if (total < 3) {
          alert(
            "The minimum order quantity is 3. Please add more to your shopping cart before checking out"
          );
          evt.preventDefault();
        }
      });
    </script>
  </body>
</html>
