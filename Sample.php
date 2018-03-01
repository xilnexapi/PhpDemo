<?php

function testPostApiAction(){

	//setup all required field in curl
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://api.xilnex.com/logic/v2/Clients/client");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);             
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

	//start building post array
	$billingObject = array(
         "street" => null,
         "city" => "landofheathen",
         "state" => "CALIFORNIA",
         "zipcode" => "4324",
         "country" => "indonesia"
      );

	$clientObject = array("currency" => null,
      "id" => 0,
      "name" => "fujikof fujio",
      "alternateLookup" => null,
      "priceScheme" => null,
      "terms" => 0,
      "creditLimit" => 0,
      "billingAddress" => null,
      "shippingAddress" => null,
      "shipping" => null,
      "billing" => $billingObject,
      "code" => null,
      "title" => null,
      "email" => null,
      "type" => null,
      "group" => null,
      "registrationCode" => null,
      "gender" => "MALE",
      "dob" => null,
      "ic" => "A789565",
      "nationality" => null,
      "createdBy" => null,
      "firstName" => "fujiko",
      "lastName" => "f fujio",
      "phone" => null,
      "office" => null,
      "mobile" => "0159623186",
      "alternateName" => null,
      "alternateContact" => null,
      "alternatePhone" => null,
      "additionalInfo" => null,
      "fax" => null,
      "remarks" => null,
      "billingRemarks" => null,
      "shippingRemarks" => null,
      "race" => null,
      "category" => "Personal",
      "active" => false,
      "allowAllOutlets" => true,
      "gstInclusive" => false,
      "pointValue" => 0,
      "defaultSalesType" => null,
      "expiryDate" => null,
      "createdOutlet" => null,
      "pointFactor" => 0,
      "dedicatedSalesPerson" => null,
      "image" => "",
      "xilnexConnectOutlet" => null,
      "payTerm" => null,
      "gstNo" => null,
      "currencyCode" => null,
      "gstNumber" => null,
      "taxCode" => null,
      "createDate" => null,
      "customFieldValue12" => null,
      "string_extend_2" => "Personal",
      "enableDOB" => false,
      "listBranchClients" => null);

	$clientsArray=array('client'=>$clientObject);

	//convert array to json and post it
	$post_json = json_encode($clientsArray); 
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
		'dkey: FILL_IN_YOUR_DKEY',
		'token: FILL_IN_YOUR_TOKEN',                                                                        
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($post_json))                                                                       
	);       

	//print respoonse & stats
	$response = curl_exec($ch);
	$results = json_decode($response, true);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	// echo "<pre>" ;
	// echo json_encode($post_array, JSON_PRETTY_PRINT);
	// echo "</pre>";

	echo '<br /><br />[testPostApiAction] Took ' . $info['total_time'] . ' seconds to complete a request to ' . $info['url'].'<br /><br />';

	echo "<br /><br />rawdata: ";
	echo json_encode($post_json, true);

	echo "<br /><br />results: ";
	echo json_encode($results, true);
	echo "<br /><br />info:";
	echo json_encode($info, true);
	echo "<br /><br />error:";
	echo json_encode($error, true);
	curl_close($ch);
}

function testGetApiAction(){

	//setup all required field in curl
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://api.xilnex.com/logic/v2/Clients/Query?email=email@xilnex.com");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);             
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
		'dkey: FILL_IN_YOUR_DKEY',
		'token: FILL_IN_YOUR_TOKEN',
		'Content-Type: application/json')                                                                       
	);       

	//print respoonse & stats
	$response = curl_exec($ch);
	$results = json_decode($response, true);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);

	// echo "<pre>" ;
	// echo json_encode($post_array, JSON_PRETTY_PRINT);
	// echo "</pre>";

	echo '<br /><br />[testGetApiAction] Took ' . $info['total_time'] . ' seconds to complete a request to ' . $info['url'].'<br /><br />';
	echo "<br /><br />results: ";
	echo json_encode($results, true);
	echo "<br /><br />info:";
	echo json_encode($info, true);
	echo "<br /><br />error:";
	echo json_encode($error, true);
	curl_close($ch);
}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?= testPostApiAction();?>
</body>
</html>