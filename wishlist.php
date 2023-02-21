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
 							<img class="card-img-top" src="img/product/<?php echo $wishlistdetails['img'] ?>" style="height: 250px;" alt="Card image cap">
 							<div class="card-img-overlay">
 								<a href="#" class="card-link"><i class="fa fa-trash" aria-hidden="true"></i></a>
 							</div>
 							<ul class="list-group list-group-flush">
 								<li class="list-group-item"><a href="shop-details.php?id=<?php echo $wishlistdetails['id'] ?>"><?php echo $wishlistdetails['name'] ?></a></li>
 								<li class="list-group-item"><?php echo $wishlistdetails['price'] ?></li>
 							</ul>
 							<div class="card-body">
 								<a href="index.php" class="card-link">Add To Bag</a>
 							</div>
 						</div>
 					</div>
 			<?php
					}
				}
				?>
 		</div>
 	</div>

 </body>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 </html>
 <?php include("components/footer.php"); ?>