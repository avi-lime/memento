 <?php include("components/header.php");
	include("global/api/conn.php");
	$userid = $_REQUEST['userid'] ?>

 <head>
 	<title>Wishlist</title>
 </head>

 <body>
 	<section class="breadcrumb-option" style="padding:15px 0 !important;">
 		<div class="container">
 			<div class="row">
 				<div class="col-lg-12">
 					<div class="breadcrumb__text">
 						<h4>Shop</h4>
 						<div class="breadcrumb__links">
 							<a href="./index.php">Home</a>
 							<span>Shop</span>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</section>
 	<div class="container" style="padding-top: 20px; padding-bottom:20px">
 		<div class="row">
 			<?php
				$sql = 'SELECT * FROM wishlist WHERE user_id=' . $userid . '';
				if ($result = mysqli_query($conn, $sql)) {
					//print_r($result);
					while ($wishlist = mysqli_fetch_assoc($result)) {
						$sql = 'SELECT * FROM product WHERE id = ' . $wishlist['product_id'] . '';
						$product_result = mysqli_query($conn, $sql);
						//print_r($product_result);
						$wishlistdetails = mysqli_fetch_assoc($product_result)
				?>
 					<div class="col-md-3">
 						<div class="card" style="width: 18rem;">
						<a href="shop-details.php?product_id=<?php echo $wishlistdetails['id'] ?>">
 							<img class="card-img-top" src="global/assets/images/
							<?php
							$sql = 'SELECT image FROM product_images WHERE product_id = "' . $wishlist['product_id'] . '" LIMIT 1';
							$image = mysqli_fetch_assoc(mysqli_query($conn, $sql));
							echo $image['image']; ?>
							" style="height: 350px;" alt="<?php echo $wishlistdetails['name'] ?>">
							</a>
 							<div class="card-img-overlay">
 								<a href="" style="color:grey" class="delete" id="<?php echo $wishlist['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
 							</div>
 							<ul class="list-group list-group-flush">
 								<li class="list-group-item" style="border:none"><?php echo $wishlistdetails['name'] ?></li>
 								<li class="list-group-item">₹
 									<?php $originalprice = $wishlistdetails['price'];
										$discountrate = $wishlistdetails['discount'];
										$discountprice = $originalprice * ($discountrate / 100);
										$price = $originalprice - $discountprice;
										echo $price;
										?><span style="color: #b7b7b7;font-size: 15px;font-weight: 400;margin-left: 10px;text-decoration: line-through">₹<?php echo $wishlistdetails['price'] ?></span></li>
 							</ul>
 							<div class="card-body">
 								<a href="shopping-cart.php" style="color:#ff3e6c;text-decoration: none" class="addtobag">Add To Bag</a>
 							</div>
 						</div>
 					</div>
 			<?php
					}
				}
				?>
 		</div>
 	</div>
 <script>
	    $(".delete").click(function(e) {
        e.preventDefault();
        var id = $(this).attr("id");
		console.log(id);
        $.ajax({
            url: "api/wishlist.php",
            method: "post",
            data: {
                wishlistid: id
            },
            success: function(data) {
                console.log("product added to wishlist")
				document.location.reload();
            }
        })
    })
 </script>
 <?php include("components/footer.php"); ?>