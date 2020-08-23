<?php
	session_start();
	$username = $_SESSION['username'];
	$fullname = $_SESSION['buyer_name'];
	require("../../instamojo/instamojo.php");

	$amount = $_GET['amount'];
	$plans = $_GET['plans'];
	$storage = $_GET['storage'];


	$api = new Instamojo\Instamojo('test_0507b2cbfdb4f06c0110f783653', 'test_41ec165e7d142fa30f9a38834a9', 'https://test.instamojo.com/api/1.1/');

	try {
    	$response = $api->paymentRequestCreate(array(
        "purpose" => "PICDRIVE PLANS",
        "amount" => $amount,
        "send_email" => true,
        "buyer_name" => $fullname,
        "email" => $username,
        "phone" => "",
        "redirect_url" => "http://localhost/picdrive/profile/php/update_storage.php?&plans=".$plans."&storage=".$storage
	        ));
	   
	   $payment_url = $response['longurl'];
	   header("Location:$payment_url");
	}
	catch (Exception $e) {
	    print('Error: ' . $e->getMessage());
	}


?>
