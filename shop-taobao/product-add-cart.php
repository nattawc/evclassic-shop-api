<?php
	@session_start();

//1. ชื่อร้านค้า
//2. itemId ของสินค้า
//3. ออฟชั่น 1 
//4. ออฟชั่น 2 
//5. ออฟชั่น 3 
//6. sku_id
//7. ชื่อ  ออฟชั่น 1  2 3
//8. รูป  ออฟชั่น 1  2 3




	if(!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "add-cart") {
		$index = $_REQUEST['p_item_id'] . "|" . $_REQUEST['p_opt_0'] . "|" . $_REQUEST['p_opt_1'] . "|" . $_REQUEST['p_opt_2'];
		
		// find props
		
	
		
		$pPath = "";
		if($_REQUEST['p_opt_0'] != "") {
			$buff = str_replace("_", ":", substr($_REQUEST['p_opt_0'], 6));
			$pPath .= $buff . ";";
		}		
		if($_REQUEST['p_opt_1'] != "") {
			$buff = str_replace("_", ":", substr($_REQUEST['p_opt_1'], 6));
			$pPath .= $buff . ";";
		}		
		if($_REQUEST['p_opt_2'] != "") {
			$buff = str_replace("_", ":", substr($_REQUEST['p_opt_2'], 6));
			$pPath .= $buff . ";";
		}		
		if($pPath != "") {
			$pPath = substr($pPath, 0, strlen($pPath) -1);
		}
		
		
		
		$sku = "";
		//print_r($_SESSION['product']['pData']['skuBase']['sku']);
		for($i = 0; $i < count($_SESSION['product']['pData']['skuBase']['skus']); $i++) {
			
			$row = $_SESSION['product']['pData']['skuBase']['skus'][$i];
			// echo $pPath;
			// print_r($row);
			if($row['propPath'] == $pPath) {
				$sku = $row['skuId'];
				break;
			}
			
		}
		
		//$sku_price = 0;
		$sku_price = $_SESSION['product']['pPrice'];
		// print_r( $_SESSION['product']['pMockData']->skuCore->sku2info);
		foreach($_SESSION['product']['pMockData']->skuCore->sku2info as $k => $v) {
			// echo $k . " => " . $sku;
			if($k == $sku) {
				$sku_price = $v->price->priceText;
			}
		}
		
		
		
		$optArray = array();
		$props = $_SESSION['product']['pData']['skuBase']['props'];
		for($i = 0; $i < 3; $i++) {
			$optInName = "";
			$optInPicture = "";
			
			$opt = explode("_", substr($_REQUEST['p_opt_' . $i], 6));
			
			for($j = 0; $j < count($props); $j++) {
				if(isset($opt[0]) && $props[$j]['pid'] == $opt[0]) {
					for($k = 0; $k < count($props[$j]['values']); $k++) {
						if(isset($opt[1]) && $props[$j]['values'][$k]['vid'] == $opt[1]) {
							$optInName = $props[$j]['values'][$k]['name'];
							if(isset($props[$j]['values'][$k]['image'])) {
								$optInPicture = $props[$j]['values'][$k]['image'];
							}
						}
					}
				}
			}
			
			$optArray[$i] = array(
				"name" => $optInName,
				"picture" => $optInPicture,
			);
		}
		
		if(!isset($_SESSION['cart'][$index])) {
			$_SESSION['cart'][$index] = array(
				"shop_name" => $_SESSION['product']['pData']['seller']['shopName'],
				"item_id" => $_REQUEST['p_item_id'],
				"item_title" => $_SESSION['product']['pTitle'],
				"option_0_id" => str_replace("_", ":", substr($_REQUEST['p_opt_0'], 6)),
				"option_1_id" => str_replace("_", ":", substr($_REQUEST['p_opt_1'], 6)),
				"option_2_id" => str_replace("_", ":", substr($_REQUEST['p_opt_2'], 6)),
				"option_sku" => $sku,
				"option_sku_price" => $sku_price,
				"option_0_name" => isset($optArray[0]['name']) ? $optArray[0]['name'] : "" ,
				"option_1_name" => isset($optArray[1]['name']) ? $optArray[1]['name'] : "" ,
				"option_2_name" => isset($optArray[2]['name']) ? $optArray[2]['name'] : "" ,
				"option_0_picture" =>  isset($optArray[0]['picture']) ? $optArray[0]['picture'] : "" ,				"option_1_picture" =>  isset($optArray[1]['picture']) ? $optArray[1]['picture'] : "" ,
				"option_2_picture" =>  isset($optArray[2]['picture']) ? $optArray[2]['picture'] : "" ,
				"qty" => 0,
			);
		} 
		$_SESSION['cart'][$index]['qty'] += $_REQUEST['p_qty'];

		echo "SUCCESS";
	}
?>