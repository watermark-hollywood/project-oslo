<?php 
	set_time_limit(0);

// ---------------------------------------------------------------------------------
//  FILENAME:      update-prduct-description.php
//
//  DESCRIPTION:   Update Product Description 
//
//  NOTES:         This source script is used to update product descriptions
//
//  COPYRIGHTS:    Copyright (c) Watermark 2017
//                 All Rights Reserved                                     
//
//  HISTORY:
//
//    MM/DD/YY  WHO        NOTES
// ---------------------------------------------------------------------------------
//    04/13/17  RAM     Created this file
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
	$product_id 	= 	filter_var(trim($_POST["product_id"]), FILTER_SANITIZE_STRING);
	$product_description = 	filter_var(trim($_POST["product_description"]), FILTER_SANITIZE_STRING);

	if($_POST["product_id"]){
		// --------------------------------------------------------------------------  
		// Look the domain up in the database.
		// --------------------------------------------------------------------------  
		$query = "UPDATE products SET description = '$product_description' WHERE id = '$product_id';"; 
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