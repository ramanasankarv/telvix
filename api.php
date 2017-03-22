<?session_start();
$szezserverip="5.9.101.139";
$szAPIport="18000";
$page=$_POST['page'];




if($page=="login"){
	$szuserid=$_POST["userid"];
	$szpassword=$_POST["password"];
	$str=vsprintf("%s:%s",array($szuserid,$szpassword));
	$strenc=base64_encode($str);
	// Web API: createtokenbased64 
	$apiurl=vsprintf("http://%s:%s/token/createtokenbased64?encrpty=%s",array($szezserverip,$szAPIport,$strenc));
	$szreponse = file_get_contents($apiurl);
	$sztoken=substr($szreponse,6,strlen($sztoken)-2);
	if($sztoken>0){
		$_SESSION["token"]=$sztoken;
		$result["code"]=200;
		$result["status"]="success";
	}else{
		$result["code"]=$sztoken;
		$result["status"]="fail";
	}
	echo json_encode($result);
}else{
	if($_SESSION["token"]!=""){
		if($page=="logout"){
			$apiurl=vsprintf("http://%s:%s/token/destroytoken?token=%s",array($szezserverip,$szAPIport,$_SESSION["token"]));
			$szuptime = file_get_contents($apiurl);
			$result["code"]=200;
			$result["status"]="success";
			echo json_encode($result);
		}
		else if($page=="systeminfo"){
			$apiurl=vsprintf("http://%s:%s/server/system_info_inquery?token=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["token"],'sdfdf'));
			$res = file_get_contents($apiurl);

			$response = split("\r\n", $res);
			echo json_encode($response);
		}	
	}
	else{
		$result["code"]=400;
		$result["status"]="login";
		echo json_encode($result);
	}	
}

// New User Profile
$szUsername="root";
$szPassoword="123456";
$szGroupName="basic";
$szExpiredTime="12/30/2019";

// Get token
$sztoken=substr($szreponse,6,strlen($sztoken)-2);
// Web API: add_user with token
$apiurl=vsprintf("http://%s:%s/server/add_user?token=%s&username=%s&password=%s&group=%s&expired_time=%s",array($szezserverip,$szAPIport,$sztoken,
$szUsername,$szPassoword,$szGroupName,$szExpiredTime));
$szuptime = file_get_contents($apiurl);
echo $szuptime;
// Web API: destroytoken with token
$apiurl=vsprintf("http://%s:%s/token/destroytoken?token=%s",array($szezserverip,$szAPIport,$sztoken));
$szuptime = file_get_contents($apiurl);
?>