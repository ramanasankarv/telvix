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
		$_SESSION["token"]=urlencode(str_replace("\r\n", "", $sztoken));
		$result["code"]=200;
		$result["status"]="success";
		$result["status"]=$_SESSION["token"];
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
		}else if($page=="channel"){
			$apiurl=vsprintf("http://%s:%s/server/query_channel_list?token=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["token"],'sdfdf'));
			$res = file_get_contents($apiurl);

			$response = split("\r\n", $res);
			//print_r($response);
			
			$j=0;
			for($i=0;$i<count($response);$i=$i+8){
				//echo "sdfd";
				$res1= array();
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[]=str_replace("CH=", "", $response[$i]);
					$res1[]=str_replace("name=", "", $response[$i+1]);
					$res1[]=str_replace("src=", "", $response[$i+2]);
					$image =str_replace("icon=", "", $response[$i+3]);
					if($image!=""){
						$res1[]="<img src='". str_replace("file://", "http://".$szezserverip.":".$szAPIport."/", $image)."' width='90px'>";	
					}
					else{
						$res1[]='';	
					}
					$res1[]=str_replace("category=", "", $response[$i+4]);
					$res1[]=str_replace("type=", "", $response[$i+5]);
					$res1[]=str_replace("status=", "", $response[$i+6]);
					//$res1[]=str_replace("bitrate=", "", $response[$i+7]);
					$output['aaData'][] = array_merge($res1, array('<a data-id="row-' . $res1[0] . '" href="javascript:editRow(' . $res1[0] . ',\''.$res1[4].'\',\''.$image.'\',\''.$res1[5].'\');" class=""><span class="glyphicon glyphicon-pencil"></a>&nbsp;<a href="javascript:removeRow(' . $res1[0] . ');" class="" style="color:red;"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;<a href="javascript:void(0)" onclick="play_movie(' . $res1[0] . ',\'flv\',0,\''.$_SESSION["token"].'\',\''.$res1[2].'\');"><span class="glyphicon glyphicon-play"></span></a>'));
					
				}
				
			}
			//die();
			echo json_encode($output);
		}else if($page=="movie"){
			$apiurl=vsprintf("http://%s:%s/server/query_movie_list?token=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["token"],'sdfdf'));
			$res = file_get_contents($apiurl);

			$response = split("\r\n", $res);
			//print_r($response);
			
			$j=0;
			for($i=0;$i<count($response);$i=$i+8){
				//echo "sdfd";
				$res1= array();
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[]=str_replace("movieno=", "", $response[$i]);
					$res1[]=str_replace("name=", "", $response[$i+1]);
					$res1[]=str_replace("src=", "", $response[$i+2]);
					$image =str_replace("img=", "", $response[$i+3]);
					if($image!=""){
						$res1[]="<img src='". str_replace("file://", "http://".$szezserverip.":".$szAPIport."/", $image)."' width='90px'>";	
					}
					else{
						$res1[]='';	
					}
					//$res1[]=str_replace("img=", "", $response[$i+3]);
					$res1[]=str_replace("category=", "", $response[$i+4]);
					$res1[]=str_replace("duration=", "", $response[$i+5]);
					$res1[]=str_replace("status=", "", $response[$i+7]);
					if($res1[6]==1)
						$res1[6]="ON";
					else
						$res1[6]="OFF";
					//$res1[]=str_replace("bitrate=", "", $response[$i+7]);
					$output['aaData'][] = array_merge($res1, array('<a data-id="row-' . $res1[0] . '" href="javascript:editRow(' . $res1[0] . ',\''.$res1[1].'\',\''.$res1[2].'\',\''.$res1[4].'\',\''.$image.'\');" class=""><span class="glyphicon glyphicon-pencil"></a>&nbsp;<a href="javascript:removeRow(' . $res1[0] . ');" class="" style="color:red;"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;<a href="javascript:void(0)" onclick="play_channel(' . $res1[0] . ',\'ch\',0,\''.$_SESSION["token"].'\',\''.$res1[2].'\');"><span class="glyphicon glyphicon-play"></span></a>'));
					
				}
				
			}
			//die();
			echo json_encode($output);
		}else if($page=="user"){
			$apiurl=vsprintf("http://%s:%s/server/query_all_user?token=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["token"],'sdfdf'));
			$res = file_get_contents($apiurl);

			$response = split("\r\n", $res);
			//print_r($response);
			
			$j=0;
			for($i=0;$i<count($response);$i=$i+7){
				//echo "sdfd";
				$res1= array();
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[]=str_replace("username=", "", $response[$i]);
					$res1[]=str_replace("password=", "", $response[$i+1]);
					$res1[]=str_replace("group=", "", $response[$i+2]);
					$res1[] =str_replace("expired_time=", "", $response[$i+3]);
					
					$res1[]=str_replace("userip=", "", $response[$i+4]);
					$res1[]=str_replace("macid=", "", $response[$i+5]);
					
					
					$output['aaData'][] = array_merge($res1, array('<a data-id="row-' . $res1[0] . '" href="javascript:editRow(\'' . $res1[0] . '\',\''.$res1[1].'\',\''.$res1[2].'\',\''.$res1[3].'\',\''.$res1[4].'\',\''.$res1[5].'\');" class=""><span class="glyphicon glyphicon-pencil"></a>&nbsp;<a href="javascript:removeRow(\'' . $res1[0] . '\');" class="" style="color:red;"><span class="glyphicon glyphicon-trash"></span></a>'));
					
				}
				
			}
			//die();
			echo json_encode($output);
		}
		else if($page=="group"){
			$apiurl=vsprintf("http://%s:%s/server/query_group?token=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["token"],'sdfdf'));
			//die($apiurl);
			$res = file_get_contents($apiurl);

			$response = split("\r\n", $res);
			//print_r($response);
			
			$j=0;
			for($i=0;$i<count($response);$i=$i+5){
				//echo "sdfd";
				$res1= array();
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[]=str_replace("No=", "", $response[$i]);
					$res1[]=str_replace("name=", "", $response[$i+1]);
					$res1[]=str_replace("connection=", "", $response[$i+2]);
					$res1[] =str_replace("src=", "", $response[$i+3]);
					
					$res1[]=str_replace("mc_src=", "", $response[$i+4]);
					
					
					$output['aaData'][] = array_merge($res1, array('<a data-id="row-' . $res1[1] . '" href="javascript:editRow(\'' . $res1[0] . '\',\''.$res1[1].'\',\''.$res1[2].'\',\''.$res1[3].'\',\''.$res1[4].'\');" class=""><span class="glyphicon glyphicon-pencil"></a>&nbsp;<a href="javascript:removeRow(\'' . $res1[1] . '\');" class="" style="color:red;"><span class="glyphicon glyphicon-trash"></span></a>'));
					
				}
				
			}
			//die();
			echo json_encode($output);
		}else if($page=="movie_cat"){
			$apiurl=vsprintf("http://%s:%s/server/get_movie_category?token=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["token"],'sdfdf'));
			//die($apiurl);
			$res = file_get_contents($apiurl);

			$response = split("\r\n", $res);
			//print_r($response);
			
			$j=0;
			$res1= array();

			for($i=0;$i<count($response);$i=$i+1){
				//echo "sdfd";
				
				//echo $response[$i];
				if($response[$i]!="" || $response[$i]!=0){
					$res1[$i]=str_replace("category=", "", $response[$i]);
					
				}
				
			}
			//die();
			echo json_encode($res1);
		}
		else if($page=="channel_view"){
			$ch_no=$_GET['ch_no'];
			$apiurl=vsprintf("http://%s:%s/server/query_channel_more?token=%s&ch_no=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$ch_no,'sdfdf'));

			$res = file_get_contents($apiurl);

			$response = split("\r\n", $res);
			//print_r($response);

			echo json_encode($response);


		}else if($page=="channel_add"){

			$ch_name=$_POST['name'];
			$src=$_POST['src'];
			$category=$_POST['category'];
			$icon=$_POST['icon'];
			$type=$_POST['type'];

			$apiurl=vsprintf("http://%s:%s/server/add_channel?token=%s&ch_name=%s&src=%s&category=%s&icon=%s&type=%s",array($szezserverip,$szAPIport,$_SESSION["token"], $ch_name,urlencode($src),urlencode($category),urlencode($icon),urlencode($type)));

			$res = file_get_contents($apiurl);
			echo ($res);

		}else if($page=="movie_add"){

			$ch_name=$_POST['name'];
			$src=$_POST['src'];
			$category=$_POST['category'];
			$icon=$_POST['icon'];
			$movie_no=$_POST['movie_no'];

			$apiurl=vsprintf("http://%s:%s/server/add_movie?token=%s&movie_name=%s&src=%s&category=%s&img=%s&movie_no=%s",array($szezserverip,$szAPIport,$_SESSION["token"], $ch_name,urlencode($src),urlencode($category),urlencode($icon),$movie_no));
			//echo $apiurl;
			$res = file_get_contents($apiurl);
			echo ($res);

		}else if($page=="user_add"){

			$user_name=$_POST['name'];
			$password=$_POST['password'];
			$group=$_POST['group'];
			$expired_time=$_POST['expired_time'];
			$ip=$_POST['ip'];
			$macid=$_POST['macid'];
			
			$apiurl=vsprintf("http://%s:%s/server/add_user?token=%s&username=%s&password=%s&group=%s&expired_time=%s&userip=%s&macid=%s",array($szezserverip,$szAPIport,$_SESSION["token"], $user_name,urlencode($password),urlencode($group),$expired_time,$ip,$macid));
			//echo $apiurl;
			$res = file_get_contents($apiurl);
			echo ($res);

		}else if($page=="group_add"){

			$name=$_POST['name'];
			$connection=$_POST['connection'];
			$channel_no=$_POST['channel_no'];
			$mc_src=$_POST['mc_src'];
			
			

			$channel=getCat($szezserverip,$szAPIport);

			$ch_src="";
			$temp=0;
			for($i=0;$i<count($channel);$i++){
				if(in_array($channel[$i], $mc_src)){
					$temp++;
					if($ch_src==""){
						$ch_src=$channel[$i]."=1";
					}else{
						$ch_src.=",".$channel[$i]."=1";	
					}
				}else{
					if($ch_src==""){
						$ch_src=$channel[$i]."=0";
					}else{
						$ch_src.=",".$channel[$i]."=0";	
					}	
				}
			}
			if($temp==0){
				$ch_src="all=1,".$ch_src;	
			}else{
				$ch_src="all=0,".$ch_src;	
			}
			
			$apiurl=vsprintf("http://%s:%s/server/add_group?token=%s&group_name=%s&group_concurrent_connection=%s&group_src=%s&group_mcsrc=%s",array($szezserverip,$szAPIport,$_SESSION["token"], $name,$connection,$channel_no,$ch_src));
			//echo $apiurl;
			//die();
			$res = file_get_contents($apiurl);
			echo ($res);

		}else if($page=="group_update"){

			$name=$_POST['name'];
			$connection=$_POST['connection'];
			$channel_no=$_POST['channel_no'];
			$mc_src=$_POST['mc_src'];
			
			

			$channel=getCat($szezserverip,$szAPIport);

			$ch_src="";
			$temp=0;
			for($i=0;$i<count($channel);$i++){
				if(in_array($channel[$i], $mc_src)){
					$temp++;
					if($ch_src==""){
						$ch_src=$channel[$i]."=1";
					}else{
						$ch_src.=",".$channel[$i]."=1";	
					}
				}else{
					if($ch_src==""){
						$ch_src=$channel[$i]."=0";
					}else{
						$ch_src.=",".$channel[$i]."=0";	
					}	
				}
			}
			if($temp==0){
				$ch_src="all=1,".$ch_src;	
			}else{
				$ch_src="all=0,".$ch_src;	
			}
			
			$apiurl=vsprintf("http://%s:%s/server/update_group?token=%s&group_name=%s&group_concurrent_connection=%s&group_src=%s&group_mcsrc=%s",array($szezserverip,$szAPIport,$_SESSION["token"], $name,$connection,$channel_no,$ch_src));
			//echo $apiurl;
			//die();
			$res = file_get_contents($apiurl);
			echo ($res);

		}else if($page=="channel_update"){
			$id=$_GET['id'];
			$ch_name=$_POST['name'];
			$src=$_POST['src'];
			$category=$_POST['category'];
			$icon=$_POST['icon'];
			$type=$_POST['type'];

			$apiurl=vsprintf("http://%s:%s/server/update_channel?token=%s&ch_no=%s&ch_name=%s&src=%s&category=%s&icon=%s&type=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$id, $ch_name,urlencode($src),urlencode($category),urlencode($icon),urlencode($type)));

			$res = file_get_contents($apiurl);
			echo ($res);

		}else if($page=="movie_update"){

			$ch_name=$_POST['name'];
			$src=$_POST['src'];
			$category=$_POST['category'];
			$icon=$_POST['icon'];
			$id=$_GET['id'];

			$apiurl=vsprintf("http://%s:%s/server/update_movie?token=%s&movie_name=%s&src=%s&category=%s&img=%s&movie_no=%s",array($szezserverip,$szAPIport,$_SESSION["token"], $ch_name,urlencode($src),urlencode($category),urlencode($icon),$id));
			//echo $apiurl;
			$res = file_get_contents($apiurl);
			echo ($res);

		}else if($page=="user_update"){

			$user_name=$_POST['name'];
			$password=$_POST['password'];
			$group=$_POST['group'];
			$expired_time=$_POST['expired_time'];
			$ip=$_POST['ip'];
			$macid=$_POST['macid'];
			
			$apiurl=vsprintf("http://%s:%s/server/update_user?token=%s&username=%s&password=%s&group=%s&expired_time=%s&userip=%s&macid=%s",array($szezserverip,$szAPIport,$_SESSION["token"], $user_name,urlencode($password),urlencode($group),$expired_time,$ip,$macid));
			//echo $apiurl;
			$res = file_get_contents($apiurl);
			echo ($res);

		}else if($page=="channel_delete"){
			$id=$_GET['id'];
			

			$apiurl=vsprintf("http://%s:%s/server/del_channel?token=%s&ch_no=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$id));

			$res = file_get_contents($apiurl);
			echo ($res);

		}else if($page=="movie_delete"){
			$id=$_GET['id'];
			

			$apiurl=vsprintf("http://%s:%s/server/del_movie?token=%s&movie_no=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$id));

			$res = file_get_contents($apiurl);
			echo ($res);

		}
		else if($page=="user_delete"){
			$id=$_GET['id'];
			

			$apiurl=vsprintf("http://%s:%s/server/del_user?token=%s&username=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$id));

			$res = file_get_contents($apiurl);
			echo ($res);

		}
		else if($page=="group_delete"){
			$id=$_GET['id'];
			

			$apiurl=vsprintf("http://%s:%s/server/del_group?token=%s&group_name=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$id));

			$res = file_get_contents($apiurl);
			echo ($res);

		}		
	}
	else{
		$result["code"]=400;
		$result["status"]="login";
		echo json_encode($result);
	}	
}

function getCat($szezserverip,$szAPIport){
	$apiurl=vsprintf("http://%s:%s/server/get_movie_category?token=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["token"],'sdfdf'));
	//die($apiurl);
	$res = file_get_contents($apiurl);

	$response = split("\r\n", $res);
	//print_r($response);
	
	$j=0;
	$res1= array();

	for($i=0;$i<count($response);$i=$i+1){
		//echo "sdfd";
		
		//echo $response[$i];
		if($response[$i]!="" || $response[$i]!=0){
			$res1[$i]=str_replace("category=", "", $response[$i]);
			
		}
		
	}

	return $res1;
}

?>