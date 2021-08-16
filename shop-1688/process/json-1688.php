<?php
	class dProduct {
		public $buffer = array();
		public $data = array();
		public $productId = "";
		function __construct($tkl) {
			if($tkl == "TEST-FROM-JSON") {
				$this->get_content_file("001");
			} else {
				$this->get_content_api($tkl);
			}
			if($this->buffer != null) {
				$this->set_content();
				$this->build_data();
			}
		}
		function get_content_file($pId) {
			$jsonString = file_get_contents( getcwd() . "/data/1688-".$pId.".json");
    		if(!empty($jsonString)) {
				$this->buffer = json_decode($jsonString, true);
			}
		}
		function is_url($url) {
			if(substr($url,0,4) == "http") {
				return true;
			}
			$regex = "((https?|ftp)\:\/\/)?"; // SCHEME 
			$regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
			$regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
			$regex .= "(\:[0-9]{2,5})?"; // Port 
			$regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
			$regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
			$regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 
			if(preg_match("/^$regex$/i", $url))  { 
				return true; 
			} 
			return false;
		}
		function get_content_api($tkl) {
			$post = [
				'apikey' => 'UCGdcakuqzDVRwiKTFOiCs49qCAI078r',
				'action'   => "detail",
				"ali" => 1,
			];
			if(is_numeric($tkl)) {
				$this->productId = $tkl;
				$post['productId'] = $tkl;
				
			} else if ($this->is_url($tkl)) {
				$url_extract = parse_url($tkl);
				// print_r($url_extract);
				$this->productId = str_replace(".html", "", str_replace("/offer/", "", $url_extract['path']));
				// echo $productId;
				$post['productId'] = $this->productId;
				
				
//				$buffer = explode("&", $url_extract['query']);
//				for($i = 0; $i < count($buffer); $i++) {
//					$buffer2 = explode("=", $buffer[$i]);
//					// var_dump($buffer2);
//					if($buffer2[0] == "object_id") {
//						$post['productId'] = $buffer2[1];
//					}
//				}
				
			} else {
				// we chat
				$post['tkl'] = $tkl;
			}
			// echo http_build_query($post);
			$curl = curl_init();
			curl_setopt_array($curl, array(
					CURLOPT_URL => "http://juiceetech.com/freelancer/taobao/api.php",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => http_build_query($post),
					CURLOPT_HTTPHEADER => array(
						"cache-control: no-cache",
						"content-type: application/x-www-form-urlencoded"
					),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if (!$err) {
			  // var_dump($response);
			}
			if(!empty($response)) {
				
				$this->buffer = json_decode($response, true);
				// echo "<pre>";
				// print_r($this->buffer); 
				if(!isset($this->buffer['data'])) {
					//echo "ERROR (" .  $this->buffer['code'] . ") : " . $this->buffer['msg'] . "<br />";
					$this->buffer = null;
				
					
				}
				
			}
			
			
		}
		function set_content() {
			
			$this->data = array(
				"pItemId" => $this->productId,
				"pTitle" =>  $this->buffer['data']['offerTitle'],
				"pImages" => $this->buffer['data']['offerImgList'],
				"pPrice" => $this->buffer['data']['skuPriceScale'],
				"pProps" => isset($this->buffer['data']['skuProps']) ? $this->buffer['data']['skuProps'] : array(),
				"pSkuInfoMap" => isset($this->buffer['data']['skuInfoMap']) ? $this->buffer['data']['skuInfoMap'] : array(),
				"pSkuParam" => $this->buffer['data']['orderParamModel']['orderParam']['skuParam'],
				"pData" => $this->buffer['data'],
			
			);
		}
		function build_data () {
			$_SESSION['product'] = $this->data;
		}

	}