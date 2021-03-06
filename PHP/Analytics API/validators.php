<?php

//-1: invalid values, 0: empty value, 1: OK
function validateParameter($param, $paramValue){


	switch($param){
		case "system"://system can not be empty
		$err = not_empty_value($paramValue);
		if(isset($err)) return 0;
		return 1;
		break;
		case "timezone"://timezone can be empty
		return 1;
		break;
		case "filter"://filter can be empty however if it is not empty its values are restricted;
		$err = check_available_values($paramValue,array("isp","device","cdn","city","country","title"));
		if(isset($err)) return -1;
		return 1;
		break;
		case "type"://type can be empty (it will be assumed ALL), if it is not empty, only all/live/vod available
		$err = check_available_values($paramValue,array("vod","live","all"));
		if(isset($err)) return -1;
		else return 1;
		break;
		case "asc"://cannot be empty
		$err = not_empty_value($paramValue);
		if(isset($err)) return 0;
		$err = check_available_values($paramValue,array("true","false"));
		if(isset($err)) return -1;
		return 1;
		break;
		case "orderBy":
		$err = not_empty_value($paramValue);
		if(isset($err)) return 0;
		$err = check_available_values($paramValue,array("plays", "percentage", "minutespplay", "hours", "trafficpplay", "traffic","views", "buffer", "exits", "join", "bitrate"));
		if(isset($err)) return -1;
		return 1;
		break;
		case "startDate":
		$err = check_valid_date($paramValue);
		if(isset($err)) return -1;
		return 1;
		break;
		case "endDate":
		$err = check_valid_date($paramValue);
		if(isset($err)) return -1;
		return 1;
		break;
		case "infoType":
		$err = not_empty_value($paramValue);
		if(isset($err)) return 0;
		$err = check_available_values($paramValue,array("daily","monthly","weekly","yesterday","day_lastweek","weekly_lastweek","monthly_lastmonth"));
		if(isset($err)) return -1;
		return 1;
		break;
		case "filterValue":
		return 1;
		break;
		case "entity":
		$err = not_empty_value($paramValue);
		if(isset($err)) return 0;
		$err = check_available_values($paramValue,array("buffer", "startFailures", "exits", "bufferEvents", "bitrate", "joinTime","concurrent", "views", "hours", "traffic","buffer"));
		if(isset($err)) return -1;
		return 1;
		break;
		case "timeUnit":
		$err = not_empty_value($paramValue);
		if(isset($err)) return 0;
		$err = check_available_values($paramValue,array("minute","hour","day"));
		if(isset($err)) return -1;
		return 1;
		case "transactionId"://can be empty and no special values
		return 1;
		break;
		case "userId"://can be empty and no special values
		return 1;
		break;
		case "ip"://validar que sea una ip
		if($paramValue!=""){
			if(filter_var($paramValue, FILTER_VALIDATE_IP)==false){
			return -1;
			}	
		}
		return 1;
		break;
		case "offset":
		if($paramValue!=""){
			$s = explode(" ", $paramValue);
			if(count($s)==2){
				$err_date = check_valid_date($s[0]);
				if(isset($err_date)) return -1;

				$time = explode(":", $s[1]);
				if(!(strlen($time[0])==2 and strlen($time[1])==2 and strlen($time[2])==2)){
					return -1;
				}
			}else{
				return -1;
			}
		}
		return 1;
		break;
		case "visualizations":
		if($paramValue!=""){
			$err = check_available_values($paramValue,array("all","start","end"));
			if(isset($err)) return -1;
		}
		
		return 1;
		break;

	}
}

	function not_empty_value($paramValue){
		if($paramValue=="") return 0;
	}
	function check_available_values($paramValue,$array){
		if($paramValue!=""){
			$all_incorrect=true;
			foreach ($array as $avail_value) {
				if($paramValue==$avail_value){
					$all_incorrect=false;
					break;
				}
			}
			if($all_incorrect){
				return -1;
			}
		}
	}
	function check_valid_date($paramValue){
		$paramSplitted = explode("-", $paramValue);
		$correctDateFormat = false;
		if(count($paramSplitted)==3 and strlen($paramSplitted[0])==4 and strlen($paramSplitted[1])==2 and strlen($paramSplitted[2])==2){
			$correctDateFormat=true;
		}
		if($paramValue!="" and $paramValue!="now" and $correctDateFormat==false){
			return -1;
		}
	}