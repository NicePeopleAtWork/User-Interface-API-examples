<?php

	/*****************************************************************
		CONFIGURATION PARAMETERS - USER ENTER PARAMETERS HERE
	*****************************************************************/

	// Global parameters to configure by customer
	$system = ""; //Use your system here
	$secret = ""; //Use your secret key for authentication here
	$timezone = "";

	// Specific report parameters to configure by customer
	$title = ""; //Report title
	$fromDateStr = ""; //Report start date
	$toDateStr = ""; //Report end date

	/*****************************************************************
		DO NOT MODIFY THE SECTION BELOW
	*****************************************************************/

	// Global parameters for URL construction
	date_default_timezone_set($timezone);
	$host = "http://reports.youbora.com:8080";

	// PHP command options acquisition:
	// 		-r -> Request for recurrent report
	// 		-h -> Help
	$options = getopt("r::h::");
	
	if ( isset( $options["h"] ) ){
        echo "\nUsage: \n";
        echo "\t-r: Acquiring a recurrent report\n";
        echo "\t-h: Help message \n\n";
        exit( 0 );
	}
	
	$recurrent = isset( $options["r"] );

	// Report date generation
	if ( $recurrent ){
		$genDate = date( "dmY", strtotime( "+1 day", strtotime( $toDateStr )));
		$title = $title."-(".date( "Y-m-d", strtotime( $fromDateStr ))."-".date( "Y-m-d", strtotime( $toDateStr )).")";
	} else {
		$genDate = date( "dmY", strtotime( $toDateStr ));
	}
	
	// Folder and reportID generation 
	$folder = md5( $system.$secret );
	$reportID = $system."-".md5( $system."_".$title."_".$fromDateStr."_".$toDateStr )."-".$genDate.".zip";

	// Print report URL
	print_r("\n");

	$url = $host."/".$folder."/".$reportID;
	print_r( $url );

	print_r("\n");
	print_r("\n");

	//TEST PRINTS
	//print_r("MD5: ".$system."_".$title."_".$fromDateStr."_".$toDateStr."\n");
	//print_r("ReportID: ".$reportID."\n");
	
?>