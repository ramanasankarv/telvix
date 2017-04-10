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
	if($page=="logout"){
			$apiurl=vsprintf("http://%s:%s/token/destroytoken?token=%s",array($szezserverip,$szAPIport,$_SESSION["playertoken"]));
			$szuptime = file_get_contents($apiurl);
			$result["code"]=200;
			$result["status"]="success";
			echo json_encode($result);
	}
	elseif($page=="category_list"){
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
	elseif($page=="category_channel"){
		$apiurl=vsprintf("http://%s:%s/server/get_channel_category?token=%s",array($szezserverip,$szAPIport,$_SESSION["playertoken"]));
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
		
	}else if($page=="channel_list"){

		$result=getChannel($szezserverip,$szAPIport);
		echo json_encode($result);	
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
		
	}else if($page=="epg"){
			$channel=$_GET['ch_no'];
			$from_year=$_GET['from_year'];
			$from_month=$_GET['from_month'];
			$to_month=$_GET['to_month'];

			$apiurl=vsprintf("http://%s:%s/server/get_epg_info?token=%s&ch_no=%s&from_year=%s&from_month=%s&to_month=%s",array($szezserverip,$szAPIport,$_SESSION["playertoken"],$channel,$from_year,$from_month,$to_month));

			$res = file_get_contents($apiurl);

			$response = split("\r\n", $res);
			//print_r($response);
			
			$j=0;
			for($i=0;$i<count($response);$i=$i+6){
				//echo "sdfd";
				$res1= array();
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[]=str_replace("starttime=", "", $response[$i]);
					$res1[]=str_replace("stoptime=", "", $response[$i+1]);
					$res1[]=str_replace("title=", "", $response[$i+2]);
					$res1[] =str_replace("description=", "", $response[$i+3]);
					
					$icon=str_replace("icon=", "", $response[$i+4]);
					$rec=str_replace("rec=", "", $response[$i+5]);

					//$res1[]=str_replace("icon=", "", $response[$i+4]);
					//$res1[]=str_replace("rec=", "", $response[$i+5]);
					$k=$j+1;
					$j++;
					$output['aaData'][] = array_merge($res1, array('<a data-id="row-' . $res1[0] . '" href="javascript:editRow(\'' . $res1[0] . '\',\''.$res1[1].'\',\''.$res1[2].'\',\''.$res1[3].'\',\''.$icon.'\',\''.$rec.'\','.$k.');" class=""><span class="glyphicon glyphicon-pencil"></a>&nbsp;<a href="javascript:removeRow(\'' . $res1[0] . '\','.$k.');" class="" style="color:red;"><span class="glyphicon glyphicon-trash"></span></a>'));
					
				}
				
			}
			//die();
			if(is_null($output))
			{
				$output=array();
				echo json_encode($output);
			}else{
				echo json_encode($output);
			}

		}
	else if($page=="channel"){
		if(!isset($_GET['category']) || $_GET['category']==""){
			$apiurl=vsprintf("http://%s:%s/server/query_channel_list?token=%s",array($szezserverip,$szAPIport,$_SESSION["playertoken"]));
			//echo $apiurl;
			$szreponse = file_get_contents($apiurl);

			$response = split("\r\n", $szreponse);

			$j=0;
			$res1= array();
			for($i=0;$i<count($response);$i=$i+8){
				//echo "sdfd";
				
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[$j]["CH"]=str_replace("CH=", "", $response[$i]);
					$res1[$j]["name"]=str_replace("name=", "", $response[$i+1]);
					$image =str_replace("icon=", "", $response[$i+3]);
					if($image!=""){
						$res1[$j]["image"]=$image;	
					}
					else{
						$res1[$j]["image"]='';	
					}
					//$res1[]=str_replace("img=", "", $response[$i+3]);
					$res1[$j]["category"]=str_replace("category=", "", $response[$i+4]);
					$res1[$j]["status"]=str_replace("status=", "", $response[$i+6]);
					$j++;

					
				}
				
			}
			echo json_encode($res1);
		}else{
			$apiurl=vsprintf("http://%s:%s/server/get_channel_list?token=%s&category=%s",array($szezserverip,$szAPIport,$_SESSION["playertoken"],$_GET['category']));

			$szreponse = file_get_contents($apiurl);

			$response = split("\r\n", $szreponse);

			$j=0;
			$res1= array();
			for($i=0;$i<count($response);$i=$i+7){
				//echo "sdfd";
				
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[$j]["CH"]=str_replace("CH=", "", $response[$i]);
					$res1[$j]["name"]=str_replace("name=", "", $response[$i+1]);
					$image =str_replace("icon=", "", $response[$i+3]);
					if($image!=""){
						$res1[$j]["image"]=$image;	
					}
					else{
						$res1[$j]["image"]='';	
					}
					$res1[$j]["status"]=str_replace("status=", "", $response[$i+6]);
					$j++;

					
				}
				
			}
			echo json_encode($res1);

		}
		
	}
	
}
function getChannel($szezserverip,$szAPIport){
	$apiurl=vsprintf("http://%s:%s/server/query_channel_list?token=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["playertoken"],'sdfdf'));
	$res = file_get_contents($apiurl);

	$response = split("\r\n", $res);
	//print_r($response);
	$res1= array();
	$j=0;
	for($i=0;$i<count($response);$i=$i+8){
		//echo "sdfd";
		$temp= array();
		//echo $response[$i];
		if($response[$i]!="" || $response[$i]!=0){
			$temp['ch_no']=str_replace("CH=", "", $response[$i]);
			$temp['ch_name']=str_replace("name=", "", $response[$i+1]);
			
			$res1[]=$temp;
		}
		
	}

	return $res1;
}

?>