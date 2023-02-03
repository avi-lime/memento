 <?php include("components/header.php"); ?>

 <head>
 	<title>Wishlist</title>
 </head>

 <body>
 	<section class="breadcrumb-option" style="padding:15px 0 !important;" >
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
	<?php
	$sql='SELECT * FROM wishlist WHERE user_id=';
	?>
 		<div class="container" style="padding-top: 20px; padding-bottom:20px">
 			<div class="row">
 				<div class="col-md-6">
 					<div class="card" style="width: 18rem;">
					 <img class="card-img-top" src="img/product/product-1.jpg" alt="Card image cap">
					 <div class="card-img-overlay">
					 <a href="#" class="card-link"><i class="fa fa-trash" aria-hidden="true"></i></a>
					 </div>
 						<ul class="list-group list-group-flush">
 							<li class="list-group-item">name(bob the builder karke dikhayenge)</li>
 						</ul>
 						<div class="card-body">
 							<a href="#" class="card-link">Add To Bag</a>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
		<?php
		?>
 </body>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 </html>
 <?php include("components/footer.php"); ?>