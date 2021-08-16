<?php
	class dProduct {
		public $buffer = array();
		public $data = array();
		function __construct() {
			
		}
		function jsonGetContent($pId) {
			$jsonString = file_get_contents( getcwd() . "/data/1688-".$pId.".json");
    		if(!empty($jsonString)) {
				$this->buffer = json_decode($jsonString, true);
			}
		}
	}