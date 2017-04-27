<?php
function timezoneDoesDST($tzId) {
    $tz = new DateTimeZone($tzId);
    echo "<pre>";
    //$date= DateTime('2017-10-27 01:45:00');
    $time = strtotime('2016-09-16 01:45:00'. ' UTC');
    $startdstArray=$tz->getTransitions($time );
    $isdst=$startdstArray[0]['isdst'];

    $time = strtotime('2016-10-16 01:45:00'. ' UTC');
    $startdstArray1=$tz->getTransitions($time );
    $isdst1=$startdstArray1[0]['isdst'];
    if($isdst1==$isdst){
    	echo "same time";
    }else{
    	echo $startdstArray[0]['offset'] - $startdstArray1[0]['offset'];
    	echo " Not same";
    }
    print_r($tz->getTransitions($time ));
}
//timezoneDoesDST('Australia/Sydney');

$temp = new Datetime('2018-10-16 01:45:00');
$temp->modify('-100 sec');
$date = $temp->format('Y-m-d H:i:s');
echo $date;

// $dateStr = '2018-10-16 01:45:00';
// $timezone = 'Australia/Sydney';
// $dtUtcDate = strtotime($dateStr. ' '. $timezone);

//  //$time = strtotime('2018-10-16 01:45:00');



// //$date = new DateTime($time, new DateTimeZone('UTC'));


// //$isDST = date("I", $time);
// print_r($dtUtcDate);
?>