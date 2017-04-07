<?php session_start();
$szezserverip="5.9.101.139";
$szAPIport="18000";
if(isset($_POST['page']))
	$page=$_POST['page'];
else if(isset($_GET['page']))
	$page=$_GET['page'];

//$szezserverip="192.168.1.135";

if($page=="login"){
	$szuserid=$_POST["userid"];
	$szpassword=$_POST["password"];
	$str=vsprintf("%s:%s",array($szuserid,$szpassword));
	$strenc=base64_encode($str);
	// Web API: createtokenbased64 
	$apiurl=vsprintf("http://%s:%s/token/createtokenbased64?encrpty=%s",array($szezserverip,$szAPIport,$strenc));

	//echo $apiurl;
	$szreponse = file_get_contents($apiurl);
	$sztoken=substr($szreponse,6,strlen($szreponse)-2);
	if($sztoken>0){
		$_SESSION["playertoken"]=urlencode(str_replace("\r\n", "", $sztoken));
		$_SESSION["playeruser"]=$szuserid;
		$_SESSION["playerpassword"]=$szpassword;
		$result["code"]=200;
		$result["status"]="success";
		$result["status"]=$_SESSION["playertoken"];
	}else{
		$result["code"]=$sztoken;
		$result["status"]="fail";
	}
	
	echo json_encode($result);
}
else{
	if($page=="category_list"){
		$apiurl=vsprintf("http://%s:%s/server/get_movie_category?token=%s",array($szezserverip,$szAPIport,$_SESSION["playertoken"]));
		//echo $apiurl;
		$szreponse = file_get_contents($apiurl);

		$response = split("\r\n", $szreponse);
		
		$j=0;
		$res1= array();

		for($i=0;$i<count($response);$i=$i+1){
		//echo "sdfd";
		
		//echo $response[$i];
			if($response[$i]!="" || $response[$i]!=0){
				$res1[$i]=str_replace("category=", "", $response[$i]);
			
			}
		
		}

		echo json_encode($res1);
		
	}
	else if($page=="movies"){
		if(!isset($_GET['category']) || $_GET['category']==""){
			$apiurl=vsprintf("http://%s:%s/server/query_movie_list?token=%s",array($szezserverip,$szAPIport,$_SESSION["playertoken"]));
			//echo $apiurl;
			$szreponse = file_get_contents($apiurl);

			$response = split("\r\n", $szreponse);

			$j=0;
			$res1= array();
			for($i=0;$i<count($response);$i=$i+7){
				//echo "sdfd";
				
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[$j]["movieno"]=str_replace("movieno=", "", $response[$i]);
					$res1[$j]["name"]=str_replace("name=", "", $response[$i+1]);
					$image =str_replace("img=", "", $response[$i+2]);
					if($image!=""){
						$res1[$j]["image"]="". str_replace("file://", "http://".$szezserverip.":".$szAPIport."/", $image)."";	
					}
					else{
						$res1[$j]["image"]='';	
					}
					//$res1[]=str_replace("img=", "", $response[$i+3]);
					$res1[$j]["category"]=str_replace("category=", "", $response[$i+3]);
					$res1[$j]["duration"]=str_replace("duration=", "", $response[$i+4]);
					$res1[$j]["status"]=str_replace("status=", "", $response[$i+6]);
					$j++;
				}
				
			}
			echo json_encode($res1);
		}else{
			$apiurl=vsprintf("http://%s:%s/server/get_movie_list?token=%s&category=%s",array($szezserverip,$szAPIport,$_SESSION["playertoken"],$_GET['category']));

			$szreponse = file_get_contents($apiurl);

			$response = split("\r\n", $szreponse);

			$j=0;
			$res1= array();
			for($i=0;$i<count($response);$i=$i+4){
				//echo "sdfd";
				
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[$j]["name"]=str_replace("name=", "", $response[$i]);
					$image =str_replace("img=", "", $response[$i+1]);
					if($image!=""){
						$res1[$j]["image"]="". str_replace("file://", "http://".$szezserverip.":".$szAPIport."/", $image)."";	
					}
					else{
						$res1[$j]["image"]='';	
					}
					$res1[$j]["status"]=str_replace("status=", "", $response[$i+3]);
					$j++;
				}
				
			}
			echo json_encode($res1);

		}
		
	}
	
}

?>