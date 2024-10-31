<?php

class EveryblockRequest {
	private $api_key = "";
	private $url = "https://api.everyblock.com/";
	
	function EveryblockRequest() {
		$includeURL;
		
		if(isset($_POST['url'])) {
			$includeURL = $_POST['url'] . '/wp-load.php';
		} else if (isset($_GET['url'])) {
			$includeURL = $_GET['url'] . '/wp-load.php';
		}
		
		if(isset($includeURL)) {
			require_once($includeURL);
			$this->api_key = get_option('everyblock_api_key', false);
		}
	}
	
	public function getAllMetros($type='json', $processed='true') {
		return $this->returnData("content/", NULL, $processed);
	}
	
	public function getLocationTimeline($metro, $location, $schemas = array(), $type='json', $processed='true') {
		$urlVars = "";
		if(count($schemas) > 0) {
			foreach($schemas as $key => $value) {
				$urlVars .= "schema=" . $value;
				if($key <= count($schemas) - 2) {
					$urlVars .= "&";
				}
			}
		}
		return $this->returnData("content/" . $metro . "/locations/" . $location . "/timeline/", $urlVars, $type, $processed);
	}
	
	public function getNeighborhoods($metro, $type='json', $processed='true') {
		return $this->returnData("content/" . $metro . "/neighborhoods/", NULL, $type, $processed);
	}
	
	public function getWards($metro, $type='json', $processed='true') {
		return $this->returnData("content/" . $metro . "/wards/", NULL, $type, $processed);
	}
	
	public function getZippres($metro, $type='json', $processed='true') {
		return $this->returnData("content/" . $metro . "/zippres/", NULL, $type, $processed);
	}
	
	public function getCustomLocations($metro, $type='json', $processed='true') {
		return $this->returnData("content/" . $metro . "/custom-locations/", NULL, $type, $processed);
	}
	
	public function getMetro($metro, $type='json', $processed='true') {
		return $this->returnData("content/" . $metro . "/", NULL, $type, $processed);
	}
	
	public function getTopNews($metro, $schemas = array(), $type='json', $processed='true') {
		$urlVars = "";
		if(count($schemas) > 0) {
			foreach($schemas as $key => $value) {
				$urlVars .= "schema=" . $value;
				if($key <= count($schemas) - 2) $urlVars .= "&";
			}
		}
		return $this->returnData("content/" . $metro . "/topnews/", $urlVars, $type, $processed);
	}
	
	public function getSchema($metro, $type='json', $processed='true') {
		return $this->returnData("content/" . $metro . "/schemas/", NULL, $type, $processed);
	}
	
	//--------------------------------------------------------------------------------------------
	
	private function createRequest($requestPath) {
		$headers = array('Authorization: Token ' . $this->api_key);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $this->url . $requestPath);    // get the url contents
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$data = curl_exec($ch); // execute curl request		
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		if($code === 200) {
			return $data;
		}
		
		return false;
	}
	
	private function returnData($requestPath, $urlVars = NULL, $type="json", $processed=true) {
		
		if(strcmp($type, "json") !== 0 && strcmp($type, "jsonp") !== 0 && strcmp($type, "xml") !== 0) {
			$type = "json";
		}
		
		$data = $this->createRequest($requestPath . "." . $type . (isset($urlVars) ? "?" . $urlVars : ""));
		
		if($data === false) {
			return false;
		}
		
		if($processed === false) {
			echo $data;
			return false;
		}

		switch ($type) {
			case "jsonp": 
				$data = substr($data, strpos($data, '('));
			case "json":
				return json_decode($data);
				break;
			case "xml":
				return simplexml_load_string($data);
				break;
			default:
				return false;
		}
		
		return false;
	}
}

if(isset($_POST['process']) && $_POST['process'] == "false") {
	$type = "json";
	if(isset($_POST['type'])) $type = $_POST['type'];

	$everyblockRequest = new EveryblockRequest();
	
	if(isset($_POST['schemas'])) {
		$schemas = explode(",", $_POST['schemas']);
	}
	
	switch($_POST['call']) { 
		case "getContent":
			$everyblockRequest->getContent($type, false);
			break;
		case "getLocationTimeline":
			$everyblockRequest->getLocationTimeline($_POST['metro'], $_POST['location'], $schemas, $type, false);
			break;
		case "getNeighborhoods":
			$everyblockRequest->getNeighborhoods($_POST['metro'], $type, false);
			break;
		case "getWards":
			$everyblockRequest->getWards($_POST['metro'], $type, false);
			break;
		case "getZippres":
			$everyblockRequest->getZippres($_POST['metro'], $type, false);
			break;
		case "getCustomLocations":
			$everyblockRequest->getCustomLocations($_POST['metro'], $type, false);
			break;
		case "getMetro":
			$everyblockRequest->getMetro($_POST['metro'], $type, false);
			break;
		case "getTopNews":
			$everyblockRequest->getTopNews($_POST['metro'], $schemas, $type, false);
			break;
		case "getSchema":
			$everyblockRequest->getSchema($_POST['metro'], false);
			break;
	}
}
?>