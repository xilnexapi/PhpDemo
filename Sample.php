<?php

function testapiAction(){

//setup all required field in curl
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://api.xilnex.com/logic/v2/sales/invoices/");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);             
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

//start building post array
	$items_array = array();

	for($i=1;$i<4;$i++){
		$item_single = array('itemCode' => '09020059'.$i.'0', 'quantity' => $i,"enterPrice"=>20*$i);
		$items_array[]=$item_single;
	}

	$collection_array =	array();	
	$collection_array[] = array('method' => 'web', 'amount' => 80);

	$billingAddress_array = array('street' => '123', 'city' => 'Shah Alam','state'=>'Selangor','zipcode'=>'50100','country'=>'MY');

	$nowDate = new DateTime();

	$sales_array=array('clientId'=>115101,"term"=>1,'dateTime'=>date_format($nowDate,"Y-m-d\TH:i:s.000\Z"),'shippingAdress'=>$billingAddress_array,'billingAddress'=>$billingAddress_array,'salesPerson'=>'Test Only','shippingRemark'=>'anytime','status'=>'CONFIRMED','outlet'=>'Training Branch','confirmOutlet'=>'Training Branch','discountPercentage'=>0,'billDiscountAmount'=>0,'cashier'=>'test cashier','recipientContact'=>'12345642','remark'=>'Order 91000XXXX','items'=>$items_array,'collection'=>$collection_array);

	$post_array = array("sale"=>$sales_array);

	//convert array to json and post it
	$post_json = json_encode($post_array); 
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
		'dkey: {dkey}',
		'token: {token}',                                                                        
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

	echo '<br /><br />Took ' . $info['total_time'] . ' seconds to complete a request to ' . $info['url'].'<br /><br />';

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
	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?= testapiAction();?>
</body>
</html>