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
		}else if($page=="channel_more"){
			$id=$_GET['id'];
			$apiurl=vsprintf("http://%s:%s/server/query_channel_more?token=%s&ch_no=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$id));
			//echo $apiurl;
			$res = file_get_contents($apiurl);

			$response = split("\r\n", $res);
			//print_r($response);

			echo json_encode($response);

		}else if($page=="channel_more_update"){
			$id=$_GET['id'];
			$sr2=$_POST['sr2'];
			$sr3=$_POST['sr3'];
			$netip=$_POST['netip'];
			$sid=$_POST['sid'];
			$tolerance=$_POST['tolerance'];
			$forward=$_POST['forward'];
			$bitratetype=$_POST['bitratetype'];
			$cacheondemand=$_POST['cacheondemand'];
			$catch_up_days=$_POST['catch_up_days'];
			$epg_channel_id=$_POST['epg_channel_id'];
			$bitratetype=$_POST['bitratetype'];


			$url="ch_no=".$id."&sr2=".$sr2."&sr3=".$sr3."&netip=".$netip."&sid=".$sid."&tolerance=".$tolerance."&forward=".$forward."&bitratetype=".$bitratetype."&cacheondemand=".$cacheondemand."&catch_up_days=".$catch_up_days."&epg_channel_id=".$epg_channel_id."&bitratetype=".$bitratetype;
			if($bitratetype==2){
				$url.="&video_format=".$_POST['video_format']."&audio_format=".$_POST['audio_format']."&mobilebitrate=".$_POST['mobilebitrate']."&sdbitrate=".$_POST['sdbitrate']."&hdbitrate=".$_POST['hdbitrate']."&preset=".$_POST['preset']."";
			}
			//save_channel_more?token=xxx&ch_no=xxxsr2=xxx&sr3=xxx&netip=xxx&sid=xxx&tolerance=xxx&forward=xxx&bitratetype=x&cacheondemand=x&catch_up_days=xx&epg_channel_id=xxx  HTTP/1.0 \r\n\r\n
			//bitratetype=2 needs to add more information: &video_format=xxx&audio_format=xxx&mobilebitrate=xxx&sdbitrate=xxx&hdbitrate=xxx&preset=xxx;

			$apiurl=vsprintf("http://%s:%s/server/save_channel_more?token=%s&%s",array($szezserverip,$szAPIport,$_SESSION["token"],$url));
			$res = file_get_contents($apiurl);

			echo $res;
		}
		else if($page=="channel"){
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
					$output['aaData'][] = array_merge($res1, array('<a data-id="row-' . $res1[0] . '" href="javascript:editRow(' . $res1[0] . ',\''.$res1[4].'\',\''.$image.'\',\''.$res1[5].'\');" class=""><span class="glyphicon glyphicon-pencil"></a>&nbsp;<a href="javascript:moreRow(' . $res1[0] . ');" class=""><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="javascript:removeRow(' . $res1[0] . ');" class="" style="color:red;"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;<a href="javascript:void(0)" onclick="play_movie(' . $res1[0] . ',\'flv\',0,\''.$_SESSION["token"].'\',\''.$res1[2].'\');"><span class="glyphicon glyphicon-play"></span></a>'));
					
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
			$id=$_GET["id"];
			

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
			
			$apiurl=vsprintf("http://%s:%s/server/update_group?token=%s&group_no=%s&group_name=%s&group_concurrent_connection=%s&group_src=%s&group_mcsrc=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$id, $name,$connection,$channel_no,$ch_src));
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
		else if($page=="epg_delete"){
			$id=$_GET['id'];
			$channel=$_GET['ch_no'];
			$starttime=$_GET['starttime'];

			$apiurl=vsprintf("http://%s:%s/server/del_epg_info?token=%s&ch_no=%s&&program_no=%s&starttime=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$channel,$id,$starttime));
			//?die();
			$res = file_get_contents($apiurl);
			echo ($res);

		}
		else if($page=="epg"){
			$channel=$_GET['ch_no'];
			$from_year=$_GET['from_year'];
			$from_month=$_GET['from_month'];
			$to_month=$_GET['to_month'];

			$apiurl=vsprintf("http://%s:%s/server/get_epg_info?token=%s&ch_no=%s&from_year=%s&from_month=%s&to_month=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$channel,$from_year,$from_month,$to_month));

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
		else if($page=="epg_add"){
			$channel=$_POST['ch_no'];
			$program_no=$_POST['program_no'];
			$starttime=$_POST['starttime'];
			$stoptime=$_POST['stoptime'];
			$program_title=$_POST['program_title'];
			$program_descrption=$_POST['program_descrption'];
			$program_icon=$_POST['program_icon'];
			$program_rec=$_POST['program_rec'];

			$apiurl=vsprintf("http://%s:%s/server/add_epg_info?token=%s&ch_no=%s&&program_no=%s&starttime=%s&stoptime=%s&program_title=%s&program_descrption=%s&program_icon=%s&program_rec=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$channel,$program_no,$starttime,$stoptime,$program_title,$program_descrption,$program_icon,$program_rec));
			
			$res = file_get_contents($apiurl);
			echo ($res);

		}
		else if($page=="epg_update"){
			$channel=$_POST['ch_no'];
			$program_no=$_POST['program_no'];
			$starttime=$_POST['starttime'];
			$stoptime=$_POST['stoptime'];
			$program_title=$_POST['program_title'];
			$program_descrption=$_POST['program_descrption'];
			$program_icon=$_POST['program_icon'];
			$program_rec=$_POST['program_rec'];

			$apiurl=vsprintf("http://%s:%s/server/update_epg_info?token=%s&ch_no=%s&&program_no=%s&starttime=%s&stoptime=%s&program_title=%s&program_descrption=%s&program_icon=%s&program_rec=%s",array($szezserverip,$szAPIport,$_SESSION["token"],$channel,$program_no,$starttime,$stoptime,$program_title,$program_descrption,$program_icon,$program_rec));

			$res = file_get_contents($apiurl);
			echo ($res);

		}
		else if($page=="channel_list"){

			$result=getChannel($szezserverip,$szAPIport);
			echo json_encode($result);	
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

function getChannel($szezserverip,$szAPIport){
	$apiurl=vsprintf("http://%s:%s/server/query_channel_list?token=%s&flag=%s",array($szezserverip,$szAPIport,$_SESSION["token"],'sdfdf'));
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