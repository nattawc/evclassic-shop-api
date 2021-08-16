<?php @session_start(); ?>
<?php if(isset($_REQUEST['x'])) {
	session_destroy();
	echo "<script>window.location='product-lists.php';</script>";

}?>
<!doctype html>
<html>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />



    <!-- Favicon -->

    <!-- Mobile Metas -->
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no"
    />

    <!-- Web Fonts  -->
    <link
      id="googleFonts"
      href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400&display=swap"
      rel="stylesheet"
      type="text/css"
    />

    <!-- Vendor CSS -->
    <link
      rel="stylesheet"
      href="./assets/vendor/bootstrap/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="./assets/vendor/fontawesome-free/css/all.min.css"
    />
    <link rel="stylesheet" href="./assets/vendor/animate/animate.compat.css" />
    <link
      rel="stylesheet"
      href="./assets/vendor/simple-line-icons/css/simple-line-icons.min.css"
    />
    <link
      rel="stylesheet"
      href="./assets/vendor/owl.carousel/assets/owl.carousel.min.css"
    />
    <link
      rel="stylesheet"
      href="./assets/vendor/owl.carousel/assets/owl.theme.default.min.css"
    />
    <link
      rel="stylesheet"
      href="./assets/vendor/magnific-popup/magnific-popup.min.css"
    />
    <link
      rel="stylesheet"
      href="./assets/vendor/bootstrap-star-rating/css/star-rating.min.css"
    />
    <link
      rel="stylesheet"
      href="./assets/vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.css"
    />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="./assets/css/theme.css" />
    <link rel="stylesheet" href="./assets/css/theme-elements.css" />
    <link rel="stylesheet" href="./assets/css/theme-blog.css" />
    <link rel="stylesheet" href="./assets/css/theme-shop.css" />

    <!-- Skin CSS -->
    <link id="skinCSS" rel="stylesheet" href="./assets/css/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="./assets/css/custom.css" />

    <!-- Head Libs -->
    <script src="./assets/vendor/modernizr/modernizr.min.js"></script>
  </head>

<body>
	<div class="container mt-3">
	<form action="product-lists.php" method="POST">
		<h4 class="m-0 p-0">ค้นหาสินค้า</h4><br />
	
		 <div class="input-group">
    <input type="text" name="tkl" class="form-control" placeholder="TKL" value="<?php echo isset($_REQUEST['tkl']) ? $_REQUEST['tkl'] : ""; ?>">
		<button type="submit" class="btn btn-primary">Search</button> 
			 
			
  </div>
	
	</form> <hr />
		<h4 class="m-0 p-0">รายละเอียดสินค้า</h4>
		<?php include("product-details.php"); ?>
		<h4 class="m-0 p-0">รายการสินค้าในตะกร้า</h4>
		<table class="table">
		<thead>
			<tr>
			<td>รหัสสินค้า</td>
			<td>ชื่อสินค้า</td>
			<td>ร้านค้า</td>
			<td>ตัวเลือกที่ 1</td>
			<td>ตัวเลือกที่ 2</td>
			<td>ตัวเลือกที่ 3</td>
			<td>จำนวน</td>
			<td>ราคาต่อหน่วย</td>
			</tr>
		</thead>
		<tbody>
			<?php // print_r($_SESSION['cart']); ?>
			<?php if(isset($_SESSION['cart'])) { ?>
			<?php foreach($_SESSION['cart'] as $k => $v) { ?>

			<tr>
			<td><?php echo $v['item_id']; ?></td>
			<td><?php echo $v['item_title']; ?><br />(SKU: <?php echo $v['option_sku']; ?>)</td>
			<td><?php echo $v['shop_name']; ?></td>
			<td><?php echo $v['option_0_name']; ?><br />
				<?php if(isset($v['option_0_picture'])) { ?><img src="<?php echo $v['option_0_picture']; ?>" width="50" /><?php } ?></td>
			<td><?php echo $v['option_1_name']; ?><br />
				<?php if(isset($v['option_1_picture'])) { ?><img src="<?php echo $v['option_1_picture']; ?>" width="50" /><?php } ?></td>
			<td><?php echo $v['option_2_name']; ?><br />
				<?php if(isset($v['option_2_picture'])) { ?><img src="<?php echo $v['option_2_picture']; ?>" width="50" /><?php } ?></td>
			<td><?php echo $v['qty']; ?></td>
			<td><?php echo $v['option_sku_price']; ?></td>
			</tr>
			<?php } ?>
			<?php } ?>
		</tbody>
		</table>
		<br />
		<button type="button" class="btn btn-danger" onClick="window.location='product-lists.php?x=x'; ">ลบตระกร้า</button>
		
	</div>

    <!-- Vendor -->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/jquery.appear/jquery.appear.min.js"></script>
    <script src="./assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="./assets/vendor/jquery.cookie/jquery.cookie.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/jquery.validation/jquery.validate.min.js"></script>
    <script src="./assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="./assets/vendor/jquery.gmap/jquery.gmap.min.js"></script>
    <script src="./assets/vendor/lazysizes/lazysizes.min.js"></script>
    <script src="./assets/vendor/isotope/jquery.isotope.min.js"></script>
    <script src="./assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="./assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="./assets/vendor/vide/jquery.vide.min.js"></script>
    <script src="./assets/vendor/vivus/vivus.min.js"></script>
    <script src="./assets/vendor/bootstrap-star-rating/js/star-rating.min.js"></script>
    <script src="./assets/vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.js"></script>
    <script src="./assets/vendor/jquery.countdown/jquery.countdown.min.js"></script>
    <script src="./assets/vendor/elevatezoom/jquery.elevatezoom.min.js"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="./assets/js/theme.js"></script>

    <!-- Current Page Vendor and Views -->
    <script src="./assets/js/views/view.shop.js"></script>

    <!-- Theme Custom -->
    <script src="./assets/js/custom.js"></script>

    <!-- Theme Initialization Files -->
    <script src="./assets/js/theme.init.js"></script>

    <!-- Examples -->
    <script src="./assets/js/examples/examples.gallery.js"></script>
	<script>
		
		let selectedOpt_0 = "";
		let selectedOpt_1 = "";
		let selectedOpt_2 = "";
		
		$("[id^='opt_0_']").on('click', function(e) {
			$("[id^='opt_0_']").removeClass('btn-danger').addClass('btn-default');
			if(selectedOpt_0 != event.target.id) {
				selectedOpt_0 = event.target.id;
				$("#" + event.target.id).removeClass('btn-default').addClass('btn-danger');
			} else {
				selectedOpt_0 = "";
			}
			
		});
		$("[id^='opt_1_']").on('click', function(e) {
			$("[id^='opt_1_']").removeClass('btn-danger').addClass('btn-default');
			if(selectedOpt_1 != event.target.id) {
				selectedOpt_1 = event.target.id;
				$("#" + event.target.id).removeClass('btn-default').addClass('btn-danger');
			} else {
				selectedOpt_1 = "";
			}
		});
		$("[id^='opt_2_']").on('click', function(e) {
			$("[id^='opt_2_']").removeClass('btn-danger').addClass('btn-default');
			if(selectedOpt_2 != event.target.id) {
				selectedOpt_2 = event.target.id;
				$("#" + event.target.id).removeClass('btn-default').addClass('btn-danger');
			} else {
				selectedOpt_2 = "";
			}
		});
		$("#cart-add").on('click', function(e) {
			let rOpt = $("#opt_c").val();
			let cOpt = 0;
			if(selectedOpt_0 != "") cOpt++;
			if(selectedOpt_1 != "") cOpt++;
			if(selectedOpt_2 != "") cOpt++;
			
			if(cOpt < rOpt) {
				alert('กรุณาเลือกออปชั่นในการสั่งซื้อสินค้า ทั้ง ' + rOpt + ' ออปชั่น');
			} else {
				let pItemId = $("#pItemId").val();
				let cartQty = $("#cart-qty").val();
				let formData = new FormData();
				formData.append('p_item_id', pItemId);
				formData.append('p_opt_0', selectedOpt_0);
				formData.append('p_opt_1', selectedOpt_1);
				formData.append('p_opt_2', selectedOpt_2);
				formData.append('p_qty', cartQty);
				formData.append('action', "add-cart");
				
				$.ajax({
					url: "./product-add-cart.php",
					type: "POST",
                    enctype: 'multipart/form-data',
					data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 800000,
					success: function(result) {
						//data - response from server
						if(result == "SUCCESS") {
							window.location.reload();
						}
					},
					error: function () {

					}
				});
				
				
			}
		});
	
	
	</script>
  </body>
</html>
<!--<pre><?php print_r($_SESSION['product']['pMockData']); ?></pre>-->

