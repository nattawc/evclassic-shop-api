<?php
	class dProduct {
		public $buffer = null;
		public $data = null;
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
			$jsonString = file_get_contents( getcwd() . "/data/taobao-".$pId.".json");
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
			];
			if(is_numeric($tkl)) {
				$post['productId'] = $tkl;
			} else if ($this->is_url($tkl)) {
				$url_extract = parse_url($tkl);
				$buffer = explode("&", $url_extract['query']);
				for($i = 0; $i < count($buffer); $i++) {
					$buffer2 = explode("=", $buffer[$i]);
					// var_dump($buffer2);
					if($buffer2[0] == "id") {
						$post['productId'] = $buffer2[1];
					}
				}
				
			} else {
				// we chat
				$post['tkl'] = $tkl;
			}
			//echo http_build_query($post);
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
			  //var_dump($response);
			}
			if(!empty($response)) {
				$this->buffer = json_decode($response, true);
				
				if(!isset($this->buffer['data'])) {
					//echo "ERROR (" .  $this->buffer['code'] . ") : " . $this->buffer['msg'] . "<br />";
					$this->buffer = null;
				
					
				}
				
			}
			
			
		}
		function set_content() {
			$itemInfo = $this->buffer['data']['data']['item'];
			$itemProps = $this->buffer['data']['data']['props'];
			$itemSkuBase = $this->buffer['data']['data']['skuBase'];
			$itemSkuProps = $this->buffer['data']['data']['skuBase']['props'];
			$itemMockData = json_decode($this->buffer['data']['data']['mockData']) ;
			

		
			
			
			$this->data = array(
				"pItemId" => $itemInfo['itemId'],
				"pTitle" => $itemInfo['title'],
				"pImages" => $itemInfo['images'],
				"pProps" => $itemSkuProps,
				"pPrice" => $itemMockData->price->price->priceText,
				"pMockData" => $itemMockData,
				"pData" => $this->buffer['data']['data'],
			
			);
		}
		function build_data () {
			$_SESSION['product'] = $this->data;
		}
	}