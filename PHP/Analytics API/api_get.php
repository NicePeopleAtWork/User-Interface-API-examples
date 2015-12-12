<?php

require_once ("interfaceAPI.php");

$system = ""; // Use your system here
$secretKey = ""; // Use your API 
$timezone = "Europe/Madrid"; // Use your account timezone

$apiHost = "ws.analytics.nicepeopleatwork.com";

/*	
********************
AUDIENCE
************************* */

$params = array("system" => $system,"timezone" => $timezone,"entity" => "city","type" => "","asc" => "false",
"orderBy" => "plays","startDate" => "now","endDate" => "now");
getRequest("audience","top",$params);

$params = array("system" => $system,"timezone" => $timezone,"entity" => "country","entity2"=> "cdn", "type" => "","asc" => "true",
"orderBy" => "plays","startDate" => "now","endDate" => "now");
getRequest("audience","top",$params);

$params = array("system" => $system,"timezone" => $timezone,"entity" => "city","type" => "","asc" => "false",
"orderBy" => "plays","startDate" => "now","endDate" => "now","filterValue" => "Bar");
getRequest("audience","top",$params);

$params = array("system" => $system,"timezone" => $timezone,"entity" => "country","entity2"=> "cdn", "type" => "","asc" => "true",
"orderBy" => "plays","startDate" => "now","endDate" => "now","filterValue" => "A");
getRequest("audience","top",$params);

//system, timezone, type, infoType, startDate, endDate, filter, filterValue
$params = array("system" => $system,"timezone" => $timezone,"type" => "","infoType"=>"daily",
	"filter"=>"", "filterValue"=> "" , "startDate" => "","endDate" => "");
getRequest("audience","globalInfo",$params);

//system, timezone, entity, startDate, endDate, type, filter, filterValue, timeUnit
$params = array("system" => $system,"timezone" => $timezone,"type" => "live","entity"=>"concurrent", "timeUnit"=>"minute",
	"filter"=>"", "filterValue"=> "" , "startDate" => "","endDate" => "");
getRequest("audience","chart",$params);

//system, timezone, filter, filterValue,entity,type,startdate,endDate
$params = array("system" => $system,"timezone" => $timezone,"type" => "live","entity"=>"concurrent",
	"filter"=>"", "filterValue"=> "A" , "startDate" => "", "endDate" => "");
getRequest("audience","chartValues",$params);

//system, timezone, type, infoType, startDate, endDate, filter, filterValue
$params = array("system" => $system,"timezone" => $timezone,"type" => "","infoType"=>"daily",
	"filter"=>"", "filterValue"=> "" , "startDate" => "","endDate" => "");
getRequest("audience","kpi",$params);

/*	
********************
QUALITY
************************** */


$params = array("system" => $system,"timezone" => $timezone,"entity" => "city","type" => "","asc" => "true",
"orderBy" => "plays","startDate" => "","endDate" => "");
getRequest("quality","top",$params);

$params = array("system" => $system,"timezone" => $timezone,"entity" => "country","entity2"=>"device","type" => "","asc" => "true",
"orderBy" => "plays","startDate" => "","endDate" => "");
getRequest("quality","top",$params);

//system, timezone, type, infoType, startDate, endDate, filter, filterValue
$params = array("system" => $system,"timezone" => $timezone,"type" => "","infoType"=>"daily",
	"filter"=>"", "filterValue"=> "" , "startDate" => "","endDate" => "");
getRequest("quality","globalInfo",$params);

//system, timezone, entity, startDate, endDate, type, filter, filterValue, timeUnit
$params = array("system" => $system,"timezone" => $timezone,"type" => "","entity"=>"exits","timeUnit"=>"minute",
	"filter"=>"", "filterValue"=> "" , "startDate" => "","endDate" => "");
getRequest("quality","chart",$params);

//system, timezone, filter, filterValue,entity,type,startdate,endDate
$params = array("system" => $system,"timezone" => $timezone,"type" => "","entity"=>"bitrate",
	"filter"=>"city", "filterValue"=> "A" , "startDate" => "","endDate" => "");
getRequest("quality","chartValues",$params);

//system, timezone, type, infoType, startDate, endDate, filter, filterValue
$params = array("system" => $system,"timezone" => $timezone,"type" => "","infoType"=>"daily",
	"filter"=>"", "filterValue"=> "" , "startDate" => "","endDate" => "");
getRequest("quality","kpi",$params);

$params = array("system" => $system,"timezone" => $timezone,"type" => "all","entity"=>"buffer","timeUnit"=>"minute",
	"filter"=>"", "filterValue"=> "" , "startDate" => "","endDate" => "");
getRequest("quality","sampleData",$params);

/*
************
ENGAGEMENT
*************
*/

$params = array("system" => $system,"timezone" => $timezone,"type" => "","entity"=>"views","timeUnit"=>"minute",
	"filter"=>"", "filterValue"=> "" , "startDate" => "","endDate" => "");
getRequest("engagement","sampleData",$params);

/*
***************************
TRACKING
***************************
*/

$params = array("system" => $system,"timezone" => $timezone,"type" => "", "startDate" => "","endDate" => "","transactionId"=>"",
	"userId"=>"","ip"=>"","offset"=>"","visualizations"=>"");
getRequest("tracking","data",$params);

/*
***************************
TRACKING v2
***************************
*/

$params = array("system" => $system,"timezone" => $timezone,"type" => "", "startDate" => "","endDate" => "","transactionId"=>"",
	"userId"=>"free","ip"=>"","offset"=>"","visualizations"=>"");
getRequest("tracking","advancedTable",$params);

$params = array("system" => $system,"timezone" => $timezone,"type" => "", "startDate" => "","endDate" => "","transactionId"=>"",
	"userId"=>"free","ip"=>"","offset"=>"","visualizations"=>"");
getRequest("tracking","advancedData",$params);

$params = array("system" => $system,"timezone" => $timezone,"type" => "", "startDate" => "","endDate" => "","transactionId"=>"",
	"userId"=>"free","ip"=>"","offset"=>"","visualizations"=>"","entity"=>"buffer");
getRequest("tracking","advancedChart",$params);

$params = array("system" => $system,"timezone" => $timezone,"type" => "", "startDate" => "","endDate" => "","transactionId"=>"",
	"userId"=>"free","ip"=>"","offset"=>"","visualizations"=>"");
getRequest("tracking","advancedGlobalInfo",$params);

/*
**************************
BASIC
*************************
*/

$params = array("system" => $system,"timezone" => $timezone,"filter" => "city","type" => "","asc" => "true",
"orderBy" => "plays","startDate" => "","endDate" => "");
getRequest("basic","top",$params);
