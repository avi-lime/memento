<?php
include("components/header.php");
include("global/api/conn.php");
$userid = $_REQUEST['userid'] ?>

<body>
	<section class="breadcrumb-option" style="padding:15px 0 !important;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb__text">
						<h4>Shop</h4>
						<div class="breadcrumb__links">
							<a href="./index">Home</a>
							<span>Wishlist</span>
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
					<div class="col-md-3 pb-2 d-flex" style="gap: 8px">
						<div class="card" style="width: 18rem; ">
							<a href="shop-details?product_id=<?= $wishlistdetails['id'] ?>">
								<img class="card-img-top" src="global/assets/images/
															<?php
															$sql = 'SELECT image FROM product_images WHERE product_id = "' . $wishlist['product_id'] . '" LIMIT 1';
															$image = mysqli_fetch_assoc(mysqli_query($conn, $sql));
															echo $image['image']; ?>
									" alt="<?= $wishlistdetails['name'] ?>" />
							</a>
							<div class="card-img-overlay">
								<a href="" style="color:white" class="delete" id="<?= $wishlist['id'] ?>"><i class="fa fa-trash"
										aria-hidden="true"></i></a>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item" style="border:none">
									<?= $wishlistdetails['name'] ?>
								</li>
								<li class="list-group-item">₹
									<?php $originalprice = $wishlistdetails['price'];
									$discountrate = $wishlistdetails['discount'];
									$discountprice = $originalprice * ($discountrate / 100);
									$price = $originalprice - $discountprice;
									echo (int) $price;
									?><span style="color: #b7b7b7;font-size: 15px;font-weight: 400;margin-left: 10px;text-decoration: line-through">₹
										<?= $wishlistdetails['price'] ?>
									</span>
								</li>
							</ul>
							<div class="card-body">
								<a href="" style="color:#ff3e6c;text-decoration: none" id="<?= $wishlistdetails["id"] ?>"
									class="addtobag">Add To
									Bag</a>
							</div>
						</div>
					</div>

					<?php
				}
			} else {
				?>
				<section class="shopping-cart spad">
					<div class="container text-center m-4">
						<h1 class="display-1">Login Please</h1>
						<p>Click <a href="login">here</a> to login</p>
					</div>
				</section>
				<?php
			}
			?>
		</div>
	</div>
	<script>
		$(document).ready(function () {
			$(".delete").click(function (e) {

				var id = $(this).attr("id");
				console.log(id);
				$.ajax({
					url: "api/delete.php",
					method: "post",
					data: {
						id: id,
						table: "wishlist"
					},
					success: function (data) {
						console.log("Product deleted")
						document.location.reload();
					}
				})
			})
			$(".addtobag").click(function (e) {
				e.preventDefault();
				var id = $(this).attr("id");
				console.log(id);
				$.ajax({
					url: "api/addtocart",
					method: "POST",
					data: {
						quantity: 1,
						size: "m",
						id: id
					},
					success: function (data) {
						location.href = "shopping-cart.php";
					}
				})
			})
		})
	</script>
	<?php include("components/footer.php"); ?>