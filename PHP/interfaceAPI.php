<?php

require_once ("validators.php");

$options = getopt("f::h::");
if(isset($options["h"])){
	echo "Usage: \n";
	echo "-h: display this message\n";
	echo "-f: display full JSON response\n";
	exit(0);
}

$full = isset($options["f"]);
$apiHost = "ws.analytics.nicepeopleatwork.com";
date_default_timezone_set ('Europe/Madrid');

/*
REQUESTS
*/
function getRequest($segment0, $segment1, $arrayParameters){
	validateParameters($segment0,$segment1,$arrayParameters);
	$url = "http://".$GLOBALS['apiHost']."/".$segment0."/".$segment1;
	completeURL($arrayParameters,$url);
	generateToken($arrayParameters["system"],$url);
	get($url);
}

function validateParameters($segment0, $segment1, $arrayParameters){
	switch ($segment0) {
		
		case "audience":
		switch($segment1) {

			case "top":
			//system, timezone, filter, type, asc, orderBy, startDate, endData
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "asc";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for asc, correct: true, false\n");
				exit(1);
			}
			$p = "orderBy";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for orderBy, correct: plays, percentage, minutespplay, hours, trafficpplay, traffic,views, buffer, exits, join, bitrate\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}

			break;

			case "globalInfo":
			//system, timezone, type, infoType, startDate, endDate, filter, filterValue
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "infoType";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: daily, monthly, weekly\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			break;	

			case "chart":
			//system, timezone, entity, startDate, endDate, type, filter, filterValue, timeUnit
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "entity";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: buffer, exits, bitrate, joinTime, concurrent, views,hours, traffic\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timeUnit";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: minute,hour,day\n");
				exit(1);
			}
			break;	

			case "chartValues":
			//filter, filterValue,entity,type,startdate,endDate
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "entity";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: buffer, exits, bitrate, joinTime, concurrent, views,hours, traffic\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}

			break;	

			case "kpi":
			//system, timezone, type, infoType, startDate, endDate, filter, filterValue
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "infoType";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: daily, monthly, weekly\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			break;

			default:
			$getParams = null;
			break;

		}
		break;

		case "quality":	
		switch($segment1) {

			case "top":
			//system, timezone, filter, type, asc, orderBy, startDate, endData
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "asc";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for asc, correct: true, false\n");
				exit(1);
			}
			$p = "orderBy";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for orderBy, correct: plays, percentage, minutespplay, hours, trafficpplay, traffic,views, buffer, exits, join, bitrate\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}

			break;

			case "globalInfo":
			//system, timezone, type, infoType, startDate, endDate, filter, filterValue
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "infoType";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: daily, monthly, weekly\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			break;	

			case "chart":
			//system, timezone, entity, startDate, endDate, type, filter, filterValue, timeUnit
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "entity";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: buffer, exits, bitrate, joinTime, concurrent, views,hours, traffic\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timeUnit";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: minute,hour,day\n");
				exit(1);
			}
			break;	

			case "chartValues":
			//filter, filterValue,entity,type,startdate,endDate
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "entity";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: buffer, exits, bitrate, joinTime, concurrent, views,hours, traffic\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}

			break;	

			case "kpi":
			//system, timezone, type, infoType, startDate, endDate, filter, filterValue
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "infoType";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: daily, monthly, weekly\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			break;

			case "sampleData":
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}

			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "entity";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: views,buffer, startup, failure\n");
				exit(1);
			}

			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			break;

			default:
			$getParams = null;
			break;

		}
		break;

		case "engagement":
		switch($segment1) {

			case "sampleData":
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}

			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "entity";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: views,buffer, startup, failure\n");
				exit(1);
			}

			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "filterValue";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			break;
			break;

			default:
			$getParams = null;
			break;

		}
		break;

		case "tracking":
		switch($segment1) {

			case "data":

			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}

			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "transactionId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for transactionId\n");
				exit(1);
			}
			$p = "userId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for userId\n");
				exit(1);
			}
			$p = "ip";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for ip, correct: 8.8.8.8, 192.168.1.1 ,...\n");
				exit(1);
			}
			$p = "offset";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for offset, correct: YYYY-MM-DD HH:mm:SS\n");
				exit(1);
			}
			$p = "visualizations";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for visualizations, correct: start,end,all\n");
				exit(1);
			}
			break;

			case "advancedTable":
$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}

			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "transactionId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for transactionId\n");
				exit(1);
			}
			$p = "userId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for userId\n");
				exit(1);
			}
			$p = "ip";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for ip, correct: 8.8.8.8, 192.168.1.1 ,...\n");
				exit(1);
			}
			$p = "offset";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for offset, correct: YYYY-MM-DD HH:mm:SS\n");
				exit(1);
			}
			$p = "visualizations";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for visualizations, correct: start,end,all\n");
				exit(1);
			}
			break;

			case "advancedData":
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}

			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "transactionId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for transactionId\n");
				exit(1);
			}
			$p = "userId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for userId\n");
				exit(1);
			}
			$p = "ip";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for ip, correct: 8.8.8.8, 192.168.1.1 ,...\n");
				exit(1);
			}
			$p = "offset";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for offset, correct: YYYY-MM-DD HH:mm:SS\n");
				exit(1);
			}
			$p = "visualizations";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for visualizations, correct: start,end,all\n");
				exit(1);
			}
			break;

			case "advancedChart":
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}

			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "entity";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: buffer, exits, bitrate, joinTime, concurrent, views,hours, traffic\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "transactionId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for transactionId\n");
				exit(1);
			}
			$p = "userId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for userId\n");
				exit(1);
			}
			$p = "ip";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for ip, correct: 8.8.8.8, 192.168.1.1 ,...\n");
				exit(1);
			}
			$p = "offset";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for offset, correct: YYYY-MM-DD HH:mm:SS\n");
				exit(1);
			}
			$p = "visualizations";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for visualizations, correct: start,end,all\n");
				exit(1);
			}
			break;

			case "advancedGlobalInfo":
			case "advancedData":
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}

			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "transactionId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for transactionId\n");
				exit(1);
			}
			$p = "userId";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for userId\n");
				exit(1);
			}
			$p = "ip";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for ip, correct: 8.8.8.8, 192.168.1.1 ,...\n");
				exit(1);
			}
			$p = "offset";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for offset, correct: YYYY-MM-DD HH:mm:SS\n");
				exit(1);
			}
			$p = "visualizations";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for visualizations, correct: start,end,all\n");
				exit(1);
			}
			break;

			default:
			$getParams = null;
			break;

		}
		break;

		case "top":
			//system, timezone, filter, type, asc, orderBy, startDate, endData
			$p = "system";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "timezone";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}
			$p = "filter";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for filter, correct: isp,cdn,device,city,country,title\n");
				exit(1);
			}
			$p = "type";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for type, correct: vod, live, all\n");
				exit(1);
			}
			$p = "asc";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for asc, correct: true, false\n");
				exit(1);
			}
			$p = "orderBy";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for orderBy, correct: plays, percentage, minutespplay, hours, trafficpplay, traffic,views, buffer, exits, join, bitrate\n");
				exit(1);
			}
			$p = "startDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for startDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}
			$p = "endDate";
			$res = validateParameter($p,$arrayParameters[$p]);
			if($res==0){
				print_r($p." cannot be empty\n");
				exit(1);
			}elseif($res==-1){
				print_r("Invalid value for endDate, correct format is: YYYY-MM-DD\n");
				exit(1);
			}

			break;


		default:
		$getParams = null;
		break;
	}
}

/*
UTILS
*/
function generateToken($systemCode, &$url){
	$pass = ""; // Use your token key here
	$time = round(microtime(true) * 1000) + 1800000;
	$token =  md5 ($time.$systemCode.$pass);
	$url = $url ."&token=".$token."&time=".$time;
}

function get($url){
	print_r("Getting ".$url."\n");
	
	$result = utf8_encode(file_get_contents($url));

	if($GLOBALS["full"]==false){
		print_r(substr($result, 0, 100)." ...\n");
	}
	else{
		print_r($result."\n");
	}
}

function completeURL($getParams,&$url){
	$first=false;
	foreach ($getParams as $key => $value) {
		if($first==false){
			$url = $url."?".$key."=".$value;
			$first=true;
		}else{
			$url = $url."&".$key."=".$value;	
		}
	}
}