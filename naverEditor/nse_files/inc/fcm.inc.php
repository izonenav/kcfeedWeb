<?
class Fcm
{	
	//테스트 AIzaSyAt8gI1vtGiblwSRcqCgVxKwYVJDkZHEMM
	//상용 AIzaSyAt8gI1vtGiblwSRcqCgVxKwYVJDkZHEMM
	var $debugMode = "N";
	var $api_key = "AIzaSyAt8gI1vtGiblwSRcqCgVxKwYVJDkZHEMM";
	var $recv_count = 0;
	var $data;
	//var $db;


	function Fcm()
	{
		//$this->api_key = $api_key;
		//$this->db = new DB_MySQL(_DBHOST , _DBID, _DBPASS, _DBNAME);
	}

	function setPushId($push_id)
	{
		$this->data["registration_ids"][$this->recv_count] = $push_id;		
	}

	function sendInit() {
		unset($this->data["registration_ids"]);
		$this->recv_count = 0;
	}

	function setMessage($field, $message)
	{
		$this->data["data"][$field] = $message;
	}
	function setIosMessage($field, $message)
	{
		$this->data["notification"][$field] = $message;
	}

	function send()
	{
		$this->data["content_available"] = true;
		$this->data["priority"] = "high";

		$this->setMessage("debugMode", $this->debugMode);
		$headers = array('Content-Type:application/json ; charset=UTF-8', 'Authorization:key='. $this->api_key);
		//https://android.googleapis.com/gcm/send
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,    'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);
		curl_setopt($ch, CURLOPT_POST,    true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($this->data));

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if (curl_errno($ch))
		{
			$return = "curl_errno : ". curl_errno($ch);
		}
		else if ($httpCode != 200)
		{
			$return = "http Error Code : ". $httpCode;
		}
		else
		{
			//echo $i. " ==> ". $response;
			//echo "<br><br>";
			
			unset($resArr);
			$resArr = json_decode($response, JSON_UNESCAPED_UNICODE);

			$success_count = $resArr["success"];
			$failure_count = $resArr["failure"];
			$return = "success:". $success_count. " , failure:". $failure_count;

			//전송실패 push_id 수집
			//$this->setFailurePushId($resArr);
		}
		
		//registration_ids 초기화
		$this->sendInit();
		curl_close($ch);

		//sleep(1);
		return $return;
	}


	function setFailurePushId($resArr) {

		$results = $resArr["results"];
		$query = "";
		$start = 0;
		for($i=0; $i<count($results); $i++) {
			if(empty($results[$i]["error"]) == false) {
				if($start > 0) {
					$query .= ",";
				}
				$start = 1;
				$query .= "('". $this->data["registration_ids"][$i] ."')";
			}
		}

		if(empty($query) == false) {
			//$this->db->que = "insert into push_failure (push_id) values ". $query;
			//$this->db->query();
		}
	}


	function insertPush($db, $type, $uid, $message){
		$DATA["type"]			= $type;
		$DATA["userUid"]		= $uid;
		$DATA["message"]	= $message;
		
		$db->Insert("push", $DATA, "insert error");
	}


	function sendGoodsPush($db, $type, $title, $seq, $imgFileBannerPath){

		$WHERE = "";

		$db->que = "SELECT pushId,osType,isPush FROM device WHERE isPush='Y'";
		$db->query();
		
		$AndroidPushArray=array();
		$iosPushArray=array();

		while($push = $db->getRow()){
			if($push["osType"]=='Android'){
				$AndroidPushArray[] = $push["pushId"];
				//array_push($AndroidPushArray,$push["pushId"]);
			}else{
				$iosPushArray[] = $push["pushId"];
				//array_push($iosPushArray,$push["pushId"]);
			}
			
		}

		$push["type"] = "GOODS";
		$push["message"] = $title;
		$push["goodsSeq"] = $seq;
		//$push["noticeSeq"] = $seq;
		$push["title"] = "좋은생각,좋은글";
		$push["body"] = $title;
		$push["sound"] = "default";
		$push["imgUrl"] = $imgFileBannerPath;

//		$isIosPush = 'N';

		foreach($AndroidPushArray as $androidKey){
			$this->setPushId($androidKey);	

			if($this->recv_count > 900){	
				$push["osType"] = "Android";
				$this->osTypeCheckSend($push);
				
				unset($this->data["registration_ids"]);
				$this->recv_count = 0;
			}else{
				$this->recv_count += 1;
			}
		}

		if(count($this->data["registration_ids"]) > 0){
			$push["osType"] = "Android";
			$this->osTypeCheckSend($push);
		}


		$this->sendInit();

		foreach($iosPushArray as $iosKey){
			$this->setPushId($iosKey);

			if($this->recv_count > 900){	
				$push["osType"] = "iOS";
				$this->osTypeCheckSend($push);
				
				unset($this->data["registration_ids"]);
				$this->recv_count = 0;
			}else{
				$this->recv_count += 1;
			}
		}

		if(count($this->data["registration_ids"]) > 0){
			$push["osType"] = "iOS";
			$this->osTypeCheckSend($push);
		}
			
	}

	function sendNoticePush($db, $type, $title, $imgFileBannerPath){

		$WHERE = "";

		$db->que = "SELECT pushId,osType,isPush FROM device WHERE isPush='Y'";
		$db->query();
		
		$AndroidPushArray=array();
		$iosPushArray=array();

		while($push = $db->getRow()){
			if($push["osType"]=='Android'){
				$AndroidPushArray[] = $push["pushId"];
				//array_push($AndroidPushArray,$push["pushId"]);
			}else{
				$iosPushArray[] = $push["pushId"];
				//array_push($iosPushArray,$push["pushId"]);
			}
			
		}

		$push["type"] = "NOTICE";
		$push["message"] = $title;
		//$push["noticeSeq"] = $seq;
		$push["title"] = "좋은생각,좋은말";
		$push["body"] = $title;
		$push["sound"] = "default";
		$push["imgUrl"] = $imgFileBannerPath;


//		$isIosPush = 'N';

		foreach($AndroidPushArray as $androidKey){
			$this->setPushId($androidKey);
			
			if($this->recv_count > 900){	
				$push["osType"] = "Android";
				$this->osTypeCheckSend($push);
				
				unset($this->data["registration_ids"]);
				$this->recv_count = 0;
			}else{
				$this->recv_count += 1;
			}
		}

		if(count($this->data["registration_ids"]) > 0){
			$push["osType"] = "Android";
			$this->osTypeCheckSend($push);
		}

		$this->sendInit();

		foreach($iosPushArray as $iosKey){
			$this->setPushId($iosKey);

			if($this->recv_count > 900){	
				$push["osType"] = "iOS";
				$this->osTypeCheckSend($push);
				
				unset($this->data["registration_ids"]);
				$this->recv_count = 0;
			}else{
				$this->recv_count += 1;
			}
		}

		if(count($this->data["registration_ids"]) > 0){
			$push["osType"] = "iOS";
			$this->osTypeCheckSend($push);
		}	
	}

	function sendSinglePush($db,$user){
		$db->que = "SELECT pushId,osType,isPush FROM device WHERE isPush='Y' AND userUid='".$user["uid"]."'";
		$db->query();

		$push = $db->getRow();
		$type = $user["type"];
		$message = $user["message"];
			
		$this->insertPush($db, $type, $user["uid"], $message);
		
		$messageLength = strlen($message);

		if($messageLength>128){
			 $message = substr($message,0, 160)."...";
		}
		$push["type"] = $type;
		$push["message"] = $message;

		$push["title"] = "좋은생각,좋은말";
		$push["body"] = $message;
		$push["sound"] = "default";

		$this->setPushId($push["pushId"]);
		$this->recv_count += 1;

		$this->osTypeCheckSend($push);

	}
	function osTypeCheckSend($push){
		//LIB::PLog("경로22:".$push["title"]);
		
		if($push["osType"]=='Android'){
			$this->setMessage("type", $push["type"]);
			$this->setMessage("message", $push["message"]);
			$this->setMessage("goodsSeq", $push["goodsSeq"]);
			$this->setMessage("imgUrl", $push["imgUrl"]);

		}else{
			$this->setIosMessage("title", $push["title"]);
			$this->setIosMessage("body", $push["message"]);
			$this->setIosMessage("sound", $push["sound"]);
			
			$this->setIosMessage("type", $push["type"]);
			$this->setIosMessage("goodsSeq", $push["goodsSeq"]);
		}
		$this->send();
	}
	
}

?>