<?php 
	set_time_limit(0);

// ---------------------------------------------------------------------------------
//  FILENAME:      add-option-value.php
//
//  DESCRIPTION:   add a value for a category option 
//
//  NOTES:         This source script is used to update cateogry descriptions
//
//  COPYRIGHTS:    Copyright (c) Watermark 2017
//                 All Rights Reserved                                     
//
//  HISTORY:
//
//    MM/DD/YY  WHO        NOTES
// ---------------------------------------------------------------------------------
//    04/14/17  RAM     Created this file
// ---------------------------------------------------------------------------------
 
// --------------------------------------------------------------------------    	  	
// Connect to the database. Include utility functions
// --------------------------------------------------------------------------  
require_once ('../includes/swdb_connect.php'); 
require_once ('../includes/utilityfunctions.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//check if its an ajax request, exit if not
	
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

	    $output = 'notajax';
	    die($output);
	}
	
	// --------------------------------------------------------------------------    	  	
	// Store the local variables.
	// --------------------------------------------------------------------------  
	$option_id 		= 	filter_var(trim($_POST["option_id"]), FILTER_SANITIZE_STRING);
	$option_name 	= 	filter_var(trim($_POST["option_name"]), FILTER_SANITIZE_STRING);
	$option_price 	= 	filter_var(trim($_POST["option_price"]), FILTER_SANITIZE_STRING);
	if(strlen($option_price) < 1){
		$option_price = "0.00";
	}
	$updated_values = "";
	$updated_prices = "";

	if($_POST["option_id"]){
		$query = "SELECT option_values, option_prices FROM category_options WHERE id = $option_id;"; 
		$result = @mysqli_query($GLOBALS["___mysqli_ston"], $query); 
		while ($row = mysqli_fetch_array($result,  MYSQLI_ASSOC)) 
    	{
    		$updated_values = $row['option_values'].', '.$option_name;
    		$updated_prices = $row['option_prices'].', '.$option_price;
		}
		// --------------------------------------------------------------------------  
		// Look the domain up in the database.
		// --------------------------------------------------------------------------  
		
		$query = "UPDATE category_options SET option_values = '$updated_values', option_prices = '$updated_prices' WHERE id = $option_id;"; 
		$result = @mysqli_query($GLOBALS["___mysqli_ston"], $query); 
		$numrows = mysqli_affected_rows($GLOBALS["___mysqli_ston"]);

		// --------------------------------------------------------------------------  
		// If the number of rows is 1 that means that this domain was found in our 
		// database. Redirect them back to verify with an error
		// --------------------------------------------------------------------------  	

		if($numrows == 1)
		{
			echo("success");
		    die();
		} else {
			echo("not found");
			die();
		}
	} else {
		echo("missing params");
		die();
	}
}


?>