<?php


include_once('includes/config.php');

// show PHP errors
ini_set('display_errors', 0);

// output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

$action = isset($_POST['action']) ? $_POST['action'] : "";


function getName($id) {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
    $query = "SELECT name 
		FROM customers 
		WHERE invoice = ".$id;

	// mysqli select query
	$results = $mysqli->query($query);
	$name = $results->fetch_assoc();;
   return  isset($name['name']) ? $name['name'] : '';
}


if ($action == 'email_invoice'){

	$fileId = $_POST['id'];
	$emailId = $_POST['email'];
	$name = getName($fileId);
	$invoice_type = $_POST['invoice_type'];
	$custom_email = $_POST['custom_email'];
   
	require_once('class.phpmailer.php');

	$mail = new PHPMailer(); // defaults to using php "mail()"

	$mail->AddReplyTo(EMAIL_FROM, EMAIL_NAME);
	$mail->SetFrom(EMAIL_FROM, EMAIL_NAME);
	$mail->AddAddress($emailId, "");

	$mail->Subject = EMAIL_SUBJECT;
	//$mail->AltBody = EMAIL_BODY; // optional, comment out and test
	if (empty($custom_email)){
	  
			$mail->MsgHTML(EMAIL_BODY_RECEIPT);
		
	} else {
	    
		$mail->MsgHTML($custom_email);
	}

	$mail->AddAttachment("./invoices/".$name.".pdf"); // attachment
    $mail->AddAttachment("./invoices/".$name.'-2'.".pdf"); // attachment
	if(!$mail->Send()) {
		 //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mail->ErrorInfo.'</pre>'
	    ));
	} else {
	   echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Invoice has been successfully send to the customer'
		));
	}

}
// download invoice csv sheet
if ($action == 'download_csv'){

	header("Content-type: text/csv"); 

	// output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
	}
 
    $file_name = 'invoice-export-'.date('d-m-Y').'.csv';   // file name
    $file_path = 'downloads/'.$file_name; // file path

	$file = fopen($file_path, "w"); // open a file in write mode
    chmod($file_path, 0777);    // set the file permission

    $query_table_columns_data = "SELECT * 
									FROM invoices i
									JOIN customers c
									ON c.invoice = i.invoice
									WHERE i.invoice = c.invoice
									ORDER BY i.invoice";

    if ($result_column_data = mysqli_query($mysqli, $query_table_columns_data)) {

    	// fetch table fields data
        while ($column_data = $result_column_data->fetch_row()) {

            $table_column_data = array();
            foreach($column_data as $data) {
                $table_column_data[] = $data;
            }

            // Format array as CSV and write to file pointer
            fputcsv($file, $table_column_data, ",", '"');
        }

	}

    //if saving success
    if ($result_column_data = mysqli_query($mysqli, $query_table_columns_data)) {
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'CSV has been generated and is available in the /downloads folder for future reference, you can download by <a href="/downloads/'.$file_name.'">clicking here</a>.'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

 
    // close file pointer
    fclose($file);

    $mysqli->close();

}

// Create customer
if ($action == 'create_customer'){

	// invoice customer information
	// billing
	$customer_name = $_POST['customer_name']; // customer name
	$customer_email = $_POST['customer_email']; // customer email
	$customer_address_1 = $_POST['customer_address_1']; // customer address
	$customer_address_2 = $_POST['customer_address_2']; // customer address
	$customer_town = $_POST['customer_town']; // customer town
	$customer_county = $_POST['customer_county']; // customer county
	$customer_postcode = $_POST['customer_postcode']; // customer postcode
	$customer_phone = $_POST['customer_phone']; // customer phone number
	$gstin_no = $_POST['gstin_no']; // customer address
	
	
	//shipping
	$customer_name_ship = $_POST['customer_name_ship']; // customer name (shipping)
	$customer_address_1_ship = $_POST['customer_address_1_ship']; // customer address (shipping)
	$customer_address_2_ship = $_POST['customer_address_2_ship']; // customer address (shipping)
	$customer_town_ship = $_POST['customer_town_ship']; // customer town (shipping)
	$customer_county_ship = $_POST['customer_county_ship']; // customer county (shipping)
	$customer_postcode_ship = $_POST['customer_postcode_ship']; // customer postcode (shipping)

	$query = "INSERT INTO store_customers (
					name,
					email,
					address_1,
					
					town,
					county,
					postcode,
					phone,
					gstin_no
				) VALUES (
					?,
					?,
					?,
					?,
					
					?,
					?,
					?,
					?
				);
			";

	/* Prepare statement */
	$stmt = $mysqli->prepare($query);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}

	/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
	$stmt->bind_param(
		'ssssssss',
		$customer_name,$customer_email,$customer_address_1,$customer_town,$customer_county,$customer_postcode,
		$customer_phone,$gstin_no);

	if($stmt->execute()){
		//if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message' => 'Customer has been created successfully!'
		));
	} else {
		// if unable to create invoice
		echo json_encode(array(
			'status' => 'Error',
			'message' => 'There has been an error, please try again.'
			// debug
			//'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
		));
	}

	//close database connection
	$mysqli->close();
}

// Create invoice
if ($action == 'create_invoice'){
//ini_set("display_errors",1);
	// invoice customer information
	// billing
	//echo "<pre>";print_R($_POST);;die;
    $GSTN = $_POST['gstin_no'];
    $less = $_POST['less'];
    $gross = $_POST['gross'];
    $tax_type = $_POST['tax_type'];
    $net = $_POST['net'];
    $amount_inword = $_POST['amount_inword'];
    $invoice_notes = $_POST['invoice_notes'];
    $invoice_language = isset($_POST['invoice_language']) ? $_POST['invoice_language'] : 'hindi'; // Default to Hindi
    
	$customer_name = $_POST['customer_name']; // customer name
	$customer_email = $_POST['customer_email']; // customer email
	$customer_address_1 = $_POST['customer_address_1']; // customer address
	$customer_address_2 = $_POST['customer_address_2']; // customer address
	$customer_town = $_POST['customer_town']; // customer town
	$customer_county = $_POST['customer_county']; // customer county
	$customer_postcode = $_POST['customer_postcode']; // customer postcode
	$customer_phone = $_POST['customer_phone']; // customer phone number
	
// 	//shipping
// 	$customer_name_ship = $_POST['customer_name_ship']; // customer name (shipping)
// 	$customer_address_1_ship = $_POST['customer_address_1_ship']; // customer address (shipping)
// 	$customer_address_2_ship = $_POST['customer_address_2_ship']; // customer address (shipping)
// 	$customer_town_ship = $_POST['customer_town_ship']; // customer town (shipping)
// 	$customer_county_ship = $_POST['customer_county_ship']; // customer county (shipping)
// 	$customer_postcode_ship = $_POST['customer_postcode_ship']; // customer postcode (shipping)

	// invoice details
	$invoice_number = $_POST['invoice_id']; // invoice number
	$custom_email = $_POST['custom_email']; // invoice custom email body
    $date_invoice = date_create(str_replace("/","-",$_POST['invoice_date']));	
	$invoice_date = date_format($date_invoice,"Y-m-d");
    //$invoice_date = date('Y-m-d',strtotime($_POST['invoice_date']));
//	$invoice_date = $_POST['invoice_date']; // invoice date
	$custom_email = $_POST['custom_email']; // custom invoice email
	$invoice_due_date = $_POST['invoice_due_date']; // invoice due date
	//$invoice_subtotal = $_POST['invoice_subtotal']; // invoice sub-total
	$invoice_shipping = $_POST['invoice_shipping']; // invoice shipping amount
	$invoice_discount = $_POST['invoice_discount']; // invoice discount
	$invoice_vat = $tax_type =='GST' ? $_POST['sgst']+$_POST['sgst'] : $_POST['igst']; // invoice vat
	$invoice_total = $_POST['invoice_total']; // invoice total
	$invoice_notes = $_POST['invoice_notes']; // Invoice notes
	$invoice_type = $_POST['invoice_type']; // Invoice type
	$invoice_status = $_POST['invoice_status']; // Invoice status
	
	$date = strtotime($invoice_date);
    $date2 = strtotime("+365 day", $date);
	$str = date('y',$date)."-".date('y',$date2);
    $invoice_name = $invoice_number."/TRT/25-26";
   
	// insert invoice into database
	$query = "INSERT INTO invoices (
					invoice,
					custom_email,
					invoice_date,

					vat,
					gross,
					less,
					net,
					notes,
				    tax_type,
					amount_inword,
					GSTN,
					language

				) VALUES (
				  	'".$invoice_number."',
				  	'".$custom_email."',
				  	'".$invoice_date."',


				  	'".$invoice_vat."',
				  	'".$gross."',
				  	'".$less."',
				  	'".$net."',

				  	'".$invoice_notes."',
				  	 '$tax_type',
				  	'".$amount_inword."',
				  	'$GSTN',
				  	'$invoice_language'
			    );
			";
	// insert customer details into database
	$query .= "INSERT INTO customers (
					invoice,
					name,
					email,
					address_1,
					address_2,
					town,
					county,
					postcode,
					phone,
					gstin_no
				) VALUES (
					'".$invoice_number."',
					'".$customer_name."',
					'".$customer_email."',
					'".$customer_address_1."',
					'".$customer_address_2."',
					'".$customer_town."',
					'".$customer_county."',
					'".$customer_postcode."',
					'".$customer_phone."',
					'".$GSTN."'
				);
			";

	// invoice product items
	foreach($_POST['invoice_product'] as $key => $value) {
	    $item_product = $value;
	    // $item_description = $_POST['invoice_product_desc'][$key];
	    $order_no = $_POST['order_no'][$key];
	    $publishing_date = $_POST['publishing_date'][$key];
	    $alloted_space = $_POST['alloted_space'][$key];
	    $rate_type = $_POST['rate_type'][$key];
	    $release_order_date = $_POST['release_order_date'][$key];
	    $ad_price = $_POST['ad_price'][$key];
         $rate_value = $_POST['rate_value'][$key];
	    // insert invoice items into database
		$query .= "INSERT INTO invoice_items (
				invoice,
				product,
				order_no,
				publishing_date,
				alloted_space,
				rate_type,
				release_order_date,
				ad_price,
				rate_value
			) VALUES (
				'".$invoice_number."',
				'".$item_product."',
				$order_no,
				'".$publishing_date."',
				$alloted_space,
				'".$rate_type."',
				'".$release_order_date."',
				$ad_price,
				$rate_value
			);
		";

	}

	header('Content-Type: application/json');

	// execute the query
	
	$qq = $mysqli -> multi_query($query);
	$last_id = $mysqli->insert_id;
	if($qq){
		//if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message' => 'Invoice has been created successfully!'
		));

		//Set default date timezone
		date_default_timezone_set(TIMEZONE);
		//Include Invoicr class
		include('invoice.php');
		//Create a new instance
		$invoice = new invoicr();

		$invoice2 = new invoicr();
		$invoice2->setSecond(true);

		// Set language for both invoices
		$invoice->setLanguage($invoice_language);
		$invoice2->setLanguage($invoice_language);

		//Set number formatting
		$invoice->setNumberFormat('.',',');
			$invoice2->setNumberFormat('.',',');
		//Set your logo
		$invoice->setLogo(COMPANY_LOGO,COMPANY_LOGO_WIDTH,COMPANY_LOGO_HEIGHT);
		$invoice2->setLogo(COMPANY_LOGO,COMPANY_LOGO_WIDTH,COMPANY_LOGO_HEIGHT);
		//Set theme color
		$invoice->setColor(INVOICE_THEME);
		//Set type
		$invoice->setType($invoice_type);
		//Set reference
		$invoice->setReference($invoice_name);
		//Set date
		$invoice->setDate($invoice_date);
		$invoice->setGST($GSTN);
		//Set due date
		$invoice->setDue($invoice_due_date);
		//Set from
		$invoice->setFrom(array(COMPANY_NAME,COMPANY_ADDRESS_1,COMPANY_ADDRESS_2,COMPANY_COUNTY,COMPANY_POSTCODE,COMPANY_MOBILE,COMPANY_FAX,COMPANY_EMAIL,COMPANY_NUMBER,COMPANY_VAT));
		//Set to
		$invoice->setTo(array('name'=>$customer_name,'add'=>$customer_address_1.",".$customer_town."<br>".$customer_county.",".$customer_postcode));
		//Ship to
	//	$invoice->shipTo(array($customer_name_ship,$customer_address_1_ship,$customer_address_2_ship,$customer_town_ship,$customer_county_ship,$customer_postcode_ship,''));
		//Add items
		// invoice product items
		
		
		//=============================second  ========
		
	
		$invoice2->setColor(INVOICE_THEME);
		//Set type
		$invoice2->setType($invoice_type);
		//Set reference
		$invoice2->setReference($invoice_name);
		//Set date
		$invoice2->setDate($invoice_date);
		$invoice2->setGST($GSTN);
		//Set due date
		$invoice2->setDue($invoice_due_date);
		//Set from
		$invoice2->setFrom(array(COMPANY_NAME,COMPANY_ADDRESS_1,COMPANY_ADDRESS_2,COMPANY_COUNTY,COMPANY_POSTCODE,COMPANY_MOBILE,COMPANY_FAX,COMPANY_EMAIL,COMPANY_NUMBER,COMPANY_VAT));
		//Set to
		$invoice2->setTo(array('name'=>$customer_name,'add'=>$customer_address_1.",".$customer_town."<br>".$customer_county.",".$customer_postcode));
		
		//print_R(array('name'=>$customer_name,'add'=>$customer_address_1.','.$customer_address_2.",".$customer_town.",".$customer_county.",".$customer_postcode));die;
	
		foreach($_POST['invoice_product'] as $key => $value) {
		    $item_product = $value;
		    // $item_description = $_POST['invoice_product_desc'][$key];
		    $order_no = $_POST['order_no'][$key];
		    $release_order_date = $_POST['release_order_date'][$key];
		    $publishing_date = $_POST['publishing_date'][$key];
		    $alloted_space = $_POST['alloted_space'][$key];
             $ad_price = $_POST['ad_price'][$key];
             $rate_value = $_POST['rate_value'][$key];
		   	if(ENABLE_VAT == true) {
		   		$item_vat = (VAT_RATE / 100) * $item_subtotal;
		   	}

		    //$invoice->addItem2($item_product,$order_no,$publishing_date,$release_order_date,$alloted_space,$rate_value,$ad_price);
		    $invoice->addItem($item_product,$order_no,$publishing_date,$release_order_date,$alloted_space,$rate_value,$ad_price);
		    $invoice2->addItem($item_product,$order_no,$publishing_date,$release_order_date,$alloted_space,$rate_value,$ad_price);
		    
		}
		
		
		//Add totals
		$invoice->addTotal("LESS 15%",$less);
		$invoice->addTotal("GROSS AMOUNT",$gross);
		$invoice2->addTotal("TOTAL AMOUNT",$gross);
		
		
		if($tax_type == 'GST') {
			$invoice->addTotal("SGST @2.5% ",$_POST['sgst']);
			$invoice->addTotal("CGST @2.5% ",$_POST['sgst']);
			$invoice2->addTotal("SGST @2.5% ",$_POST['sgst']);
			$invoice2->addTotal("CGST @2.5% ",$_POST['sgst']);
		}else{
		   $invoice->addTotal("IGST @5% ",$_POST['igst']);
		   $invoice2->addTotal("IGST @5% ",$_POST['igst']);
			
		}
		$invoice->addTotal("NET PAYABLE AMOUNT",$net,true);
		//Add Badge
	
	
		
		$invoice->setinWord($amount_inword);
		//Add Title
		$invoice->addTitle("Payment information");
		//Add Paragraph
		$invoice->addParagraph(PAYMENT_DETAILS);
		//Set footer note
		$invoice->setFooternote(FOOTER_NOTE);
		//Render the PDF
	  	//$invoice->render('invoices/'.$customer_name.'.pdf','F');
	  		
	  	
	  	//========================
	  	
	  	
	  	$invoice2->addTotal("NET PAYABLE AMOUNT",$net,true);
		//Add Badge
	
		// Customer notes:
		if(!empty($invoice_notes)) {
			$invoice2->addTitle("Customer Notes");
			$invoice2->addParagraph($invoice_notes);
		}
		
		$invoice2->setinWord($amount_inword);
		//Add Title
		$invoice2->addTitle("Payment information");
		//Add Paragraph
		$invoice2->addParagraph(PAYMENT_DETAILS);
		//Set footer note
		$invoice2->setFooternote(FOOTER_NOTE);
	//	$invoice->create_pdf($customer_name.".pdf");
	//	$invoice2->create_pdf($customer_name."-2.pdf");
	    $invoice->create_pdf($customer_name.$last_id.".pdf");
		$invoice2->create_pdf($customer_name.$last_id."-2.pdf");
		//Render the PDF
	  //	$invoice2->render('invoices/'.$customer_name.'-2'.'.pdf','F');
	  	$invoice2->setSecond(false);
	} else {
		// if unable to create invoice
		echo json_encode(array(
			'status' => 'Error',
			'message' => 'There has been an error, please try again.'
			// debug
			//'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
		));
	}

	//close database connection
	$mysqli->close();

}

// Adding new product
if($action == 'delete_invoice') {

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$id = $_POST["delete"];

	// the query
	$query = "DELETE FROM invoices WHERE invoice = ".$id.";";
	$query .= "DELETE FROM customers WHERE invoice = ".$id.";";
	$query .= "DELETE FROM invoice_items WHERE invoice = ".$id.";";

	unlink('invoices/'.$id.'.pdf');

	if($mysqli -> multi_query($query)) {
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Invoice has been deleted successfully!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	// close connection 
	$mysqli->close();

}


function doInvoice(){
    
    
    
}

// Adding new product
if($action == 'update_customer') {

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$getID = $_POST['id']; // id

	// invoice customer information
	// billing
	$customer_name = $_POST['customer_name']; // customer name
	$customer_email = $_POST['customer_email']; // customer email
	$customer_address_1 = $_POST['customer_address_1']; // customer address
	$customer_address_2 = $_POST['customer_address_2']; // customer address
	$customer_town = $_POST['customer_town']; // customer town
	$customer_county = $_POST['customer_county']; // customer county
	$customer_postcode = $_POST['customer_postcode']; // customer postcode
	$customer_phone = $_POST['customer_phone']; // customer phone number
	$gstin_no = $_POST['gstin_no']; // customer phone number
	
	//shipping
	$customer_name_ship = $_POST['customer_name_ship']; // customer name (shipping)
	$customer_address_1_ship = $_POST['customer_address_1_ship']; // customer address (shipping)
	$customer_address_2_ship = $_POST['customer_address_2_ship']; // customer address (shipping)
	$customer_town_ship = $_POST['customer_town_ship']; // customer town (shipping)
	$customer_county_ship = $_POST['customer_county_ship']; // customer county (shipping)
	$customer_postcode_ship = $_POST['customer_postcode_ship']; // customer postcode (shipping)

	// the query
	$query = "UPDATE store_customers SET
				name = ?,
				email = ?,
				address_1 = ?,
				address_2 = ?,
				town = ?,
				county = ?,
				postcode = ?,
				phone = ?,
				gstin_no = ?,

				name_ship = ?,
				address_1_ship = ?,
				address_2_ship = ?,
				town_ship = ?,
				county_ship = ?,
				postcode_ship = ?

				WHERE id = ?

			";

	/* Prepare statement */
	$stmt = $mysqli->prepare($query);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}

	/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
	$stmt->bind_param(
		'ssssssssssssssss',
		$customer_name,$customer_email,$customer_address_1,$customer_address_2,$customer_town,$customer_county,$customer_postcode,
		$customer_phone,$gstin_no,$customer_name_ship,$customer_address_1_ship,$customer_address_2_ship,$customer_town_ship,$customer_county_ship,$customer_postcode_ship,$getID);

	//execute the query
	if($stmt->execute()){
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Customer has been updated successfully!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	//close database connection
	$mysqli->close();
	
}

// Update product
if($action == 'update_product') {

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// invoice product information
	$getID = $_POST['id']; // id
	$product_name = $_POST['product_name']; // product name
	$product_desc = $_POST['product_desc']; // product desc
	$product_price = $_POST['product_price']+($_POST['product_price']*40)/100; // product price

	// the query
	$query = "UPDATE products SET
				product_name = ?,
				product_desc = ?,
				product_price = ?
			 WHERE product_id = ?
			";

	/* Prepare statement */
	$stmt = $mysqli->prepare($query);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}

	/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
	$stmt->bind_param(
		'ssss',
		$product_name,$product_desc,$product_price,$getID
	);

	//execute the query
	if($stmt->execute()){
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Rate has been updated successfully!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	//close database connection
	$mysqli->close();
	
}


// Adding new product
if($action == 'update_invoice') {

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$id = $_POST["update_id"];

	// the query
	$query = "DELETE FROM invoices WHERE invoice = ".$id.";";
	$query .= "DELETE FROM customers WHERE invoice = ".$id.";";
	$query .= "DELETE FROM invoice_items WHERE invoice = ".$id.";";

	unlink('invoices/'.$id.'.pdf');

	// invoice customer information
	// billing
	$customer_name = $_POST['customer_name']; // customer name
	$customer_email = $_POST['customer_email']; // customer email
	$customer_address_1 = $_POST['customer_address_1']; // customer address
	$customer_address_2 = $_POST['customer_address_2']; // customer address
	$customer_town = $_POST['customer_town']; // customer town
	$customer_county = $_POST['customer_county']; // customer county
	$customer_postcode = $_POST['customer_postcode']; // customer postcode
	$customer_phone = $_POST['customer_phone']; // customer phone number
	
	//shipping
	$customer_name_ship = $_POST['customer_name_ship']; // customer name (shipping)
	$customer_address_1_ship = $_POST['customer_address_1_ship']; // customer address (shipping)
	$customer_address_2_ship = $_POST['customer_address_2_ship']; // customer address (shipping)
	$customer_town_ship = $_POST['customer_town_ship']; // customer town (shipping)
	$customer_county_ship = $_POST['customer_county_ship']; // customer county (shipping)
	$customer_postcode_ship = $_POST['customer_postcode_ship']; // customer postcode (shipping)

	// invoice details
	$invoice_number = $_POST['invoice_id']; // invoice number
	$custom_email = $_POST['custom_email']; // invoice custom email body
	$invoice_date = $_POST['invoice_date']; // invoice date
	$invoice_due_date = $_POST['invoice_due_date']; // invoice due date
	$invoice_subtotal = $_POST['invoice_subtotal']; // invoice sub-total
	$invoice_shipping = $_POST['invoice_shipping']; // invoice shipping amount
	$invoice_discount = $_POST['invoice_discount']; // invoice discount
	$invoice_vat = $_POST['invoice_vat']; // invoice vat
	$invoice_total = $_POST['invoice_total']; // invoice total
	$invoice_notes = $_POST['invoice_notes']; // Invoice notes
	$invoice_type = $_POST['invoice_type']; // Invoice type
	$invoice_status = $_POST['invoice_status']; // Invoice status
	$invoice_language = isset($_POST['invoice_language']) ? $_POST['invoice_language'] : 'hindi'; // Default to Hindi

	// insert invoice into database
	$query .= "INSERT INTO invoices (
					invoice,
					invoice_date,
					invoice_due_date,
					subtotal,
					shipping,
					discount,
					vat,
					total,
					notes,
					invoice_type,
					status,
					language
				) VALUES (
				  	'".$invoice_number."',
				  	'".$invoice_date."',
				  	'".$invoice_due_date."',
				  	'".$invoice_subtotal."',
				  	'".$invoice_shipping."',
				  	'".$invoice_discount."',
				  	'".$invoice_vat."',
				  	'".$invoice_total."',
				  	'".$invoice_notes."',
				  	'".$invoice_type."',
				  	'".$invoice_status."',
				  	'".$invoice_language."'
			    );
			";
	// insert customer details into database
	$query .= "INSERT INTO customers (
					invoice,
					custom_email,
					name,
					email,
					address_1,
					address_2,
					town,
					county,
					postcode,
					phone,
					name_ship,
					address_1_ship,
					address_2_ship,
					town_ship,
					county_ship,
					postcode_ship
				) VALUES (
					'".$invoice_number."',
					'".$custom_email."',
					'".$customer_name."',
					'".$customer_email."',
					'".$customer_address_1."',
					'".$customer_address_2."',
					'".$customer_town."',
					'".$customer_county."',
					'".$customer_postcode."',
					'".$customer_phone."',
					'".$customer_name_ship."',
					'".$customer_address_1_ship."',
					'".$customer_address_2_ship."',
					'".$customer_town_ship."',
					'".$customer_county_ship."',
					'".$customer_postcode_ship."'
				);
			";

	// invoice product items
	foreach($_POST['invoice_product'] as $key => $value) {
	    $item_product = $value;
	    // $item_description = $_POST['invoice_product_desc'][$key];
	    $item_qty = $_POST['invoice_product_qty'][$key];
	    $item_price = $_POST['invoice_product_price'][$key];
	    $item_discount = $_POST['invoice_product_discount'][$key];
	    $item_subtotal = $_POST['invoice_product_sub'][$key];

	    // insert invoice items into database
		$query .= "INSERT INTO invoice_items (
				invoice,
				product,
				qty,
				price,
				discount,
				subtotal
			) VALUES (
				'".$invoice_number."',
				'".$item_product."',
				'".$item_qty."',
				'".$item_price."',
				'".$item_discount."',
				'".$item_subtotal."'
			);
		";

	}

	header('Content-Type: application/json');

	if($mysqli -> multi_query($query)) {
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Product has been updated successfully!'
		));

		//Set default date timezone
		date_default_timezone_set(TIMEZONE);
		//Include Invoicr class
		include('invoice.php');
		//Create a new instance
		$invoice = new invoicr("A4",CURRENCY,"en");

		// Set language
		$invoice->setLanguage($invoice_language);

		//Set number formatting
		$invoice->setNumberFormat('.',',');
		//Set your logo
		$invoice->setLogo(COMPANY_LOGO,COMPANY_LOGO_WIDTH,COMPANY_LOGO_HEIGHT);
		//Set theme color
		$invoice->setColor(INVOICE_THEME);
		//Set type
		$invoice->setType("Invoice");
		//Set reference
		$invoice->setReference($invoice_number);
		//Set date
		$invoice->setDate($invoice_date);
		//Set due date
		$invoice->setDue($invoice_due_date);
		//Set from
		$invoice->setFrom(array(COMPANY_NAME,COMPANY_ADDRESS_1,COMPANY_ADDRESS_2,COMPANY_COUNTY,COMPANY_POSTCODE,COMPANY_MOBILE,COMPANY_FAX,COMPANY_EMAIL,COMPANY_NUMBER,COMPANY_VAT));
		//Set to
		$invoice->setTo(array($customer_name,$customer_address_1,$customer_address_2,$customer_town,$customer_county,$customer_postcode,"Phone: ".$customer_phone));
		//Ship to
		$invoice->shipTo(array($customer_name_ship,$customer_address_1_ship,$customer_address_2_ship,$customer_town_ship,$customer_county_ship,$customer_postcode_ship,''));
		//Add items
		// invoice product items
		foreach($_POST['invoice_product'] as $key => $value) {
		    $item_product = $value;
		    // $item_description = $_POST['invoice_product_desc'][$key];
		    $item_qty = $_POST['invoice_product_qty'][$key];
		    $item_price = $_POST['invoice_product_price'][$key];
		    $item_discount = $_POST['invoice_product_discount'][$key];
		    $item_subtotal = $_POST['invoice_product_sub'][$key];

		   	if(ENABLE_VAT == true) {
		   		$item_vat = (VAT_RATE / 100) * $item_subtotal;
		   	}

		    $invoice->addItem($item_product,'',$item_qty,$item_vat,$item_price,$item_discount,$item_subtotal);
		}
		//Add totals
		$invoice->addTotal("Total",$invoice_subtotal);
		if(!empty($invoice_discount)) {
			$invoice->addTotal("Discount",$invoice_discount);
		}
		if(!empty($invoice_shipping)) {
			$invoice->addTotal("Delivery",$invoice_shipping);
		}
		if(ENABLE_VAT == true) {
			$invoice->addTotal("TAX/VAT ".VAT_RATE."%",$invoice_vat);
		}
		$invoice->addTotal("Total Due",$invoice_total,true);
		//Add Badge
		$invoice->addBadge($invoice_status);
		// Customer notes:
		if(!empty($invoice_notes)) {
			$invoice->addTitle("Cusatomer Notes");
			$invoice->addParagraph($invoice_notes);
		}
		//Add Title
		$invoice->addTitle("Payment information");
		//Add Paragraph
		$invoice->addParagraph(PAYMENT_DETAILS);
		//Set footer note
		$invoice->setFooternote(FOOTER_NOTE);
		//Render the PDF
		$invoice->render('invoices/'.$invoice_number.'.pdf','F');

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	// close connection 
	$mysqli->close();

}

// Adding new product
if($action == 'delete_product') {

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$id = $_POST["delete"];

	// the query
	$query = "DELETE FROM products WHERE product_id = ?";

	/* Prepare statement */
	$stmt = $mysqli->prepare($query);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}

	/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
	$stmt->bind_param('s',$id);

	//execute the query
	if($stmt->execute()){
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Rate has been deleted successfully!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	// close connection 
	$mysqli->close();

}

// Login to system
if($action == 'login') {

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	session_start();

    extract($_POST);

    $username = mysqli_real_escape_string($mysqli,$_POST['username']);
    $pass_encrypt = md5(mysqli_real_escape_string($mysqli,$_POST['password']));

    $query = "SELECT * FROM `users` WHERE username='$username' AND `password` = '$pass_encrypt'";

    $results = mysqli_query($mysqli,$query) or die (mysqli_error());
    $count = mysqli_num_rows($results);

    if($count!="") {
		$row = $results->fetch_assoc();

		$_SESSION['login_username'] = $row['username'];

		// processing remember me option and setting cookie with long expiry date
		if (isset($_POST['remember'])) {	
			session_set_cookie_params('604800'); //one week (value in seconds)
			session_regenerate_id(true);
		}  
		
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Login was a success! Transfering you to the system now, hold tight!'
		));
    } else {
    	echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'Login incorrect, does not exist or simply a problem! Try again!'
	    ));
    }
}

// Adding new product
if($action == 'add_product') {

	$product_name = $_POST['product_name'];
	$product_desc = $_POST['product_desc'];
	$product_price = $_POST['product_name']=="without_color" ? $_POST['product_price'] : $_POST['product_price']+($_POST['product_price']*40)/100;

	//our insert query query
	$query  = "INSERT INTO products
				(
					product_name,
					product_desc,
					product_price
				)
				VALUES (
					?, 
                	?,
                	?
                );
              ";

    header('Content-Type: application/json');

	/* Prepare statement */
	$stmt = $mysqli->prepare($query);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}

	/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
	$stmt->bind_param('sss',$product_name,$product_desc,$product_price);

	if($stmt->execute()){
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Rate been added successfully!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	//close database connection
	$mysqli->close();
}

// Adding new user
if($action == 'add_user') {

	$user_name = $_POST['name'];
	$user_username = $_POST['username'];
	$user_email = $_POST['email'];
	$user_phone = $_POST['phone'];
	$user_password = $_POST['password'];

	//our insert query query
	$query  = "INSERT INTO users
				(
					name,
					username,
					email,
					phone,
					password
				)
				VALUES (
					?,
					?, 
                	?,
                	?,
                	?
                );
              ";

    header('Content-Type: application/json');

	/* Prepare statement */
	$stmt = $mysqli->prepare($query);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}

	$user_password = md5($user_password);
	/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
	$stmt->bind_param('sssss',$user_name,$user_username,$user_email,$user_phone,$user_password);

	if($stmt->execute()){
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'User has been added successfully!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	//close database connection
	$mysqli->close();
}

// Update product
if($action == 'update_user') {

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// user information
	$getID = $_POST['id']; // id
	$name = $_POST['name']; // name
	$username = $_POST['username']; // username
	$email = $_POST['email']; // email
	$phone = $_POST['phone']; // phone
	$password = $_POST['password']; // password

	if($password == ''){
		// the query
		$query = "UPDATE users SET
					name = ?,
					username = ?,
					email = ?,
					phone = ?
				 WHERE id = ?
				";
	} else {
		// the query
		$query = "UPDATE users SET
					name = ?,
					username = ?,
					email = ?,
					phone = ?,
					password =?
				 WHERE id = ?
				";
	}

	/* Prepare statement */
	$stmt = $mysqli->prepare($query);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}

	if($password == ''){
		/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param(
			'sssss',
			$name,$username,$email,$phone,$getID
		);
	} else {
		$password = md5($password);
		/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
		$stmt->bind_param(
			'ssssss',
			$name,$username,$email,$phone,$password,$getID
		);
	}

	//execute the query
	if($stmt->execute()){
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'User has been updated successfully!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	//close database connection
	$mysqli->close();
	
}

// Delete User
if($action == 'delete_user') {

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$id = $_POST["delete"];

	// the query
	$query = "DELETE FROM users WHERE id = ?";

	/* Prepare statement */
	$stmt = $mysqli->prepare($query);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}

	/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
	$stmt->bind_param('s',$id);

	if($stmt->execute()){
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'User has been deleted successfully!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	// close connection 
	$mysqli->close();

}

// Delete User
if($action == 'delete_customer') {

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$id = $_POST["delete"];

	// the query
	$query = "DELETE FROM store_customers WHERE id = ?";

	/* Prepare statement */
	$stmt = $mysqli->prepare($query);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}

	/* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
	$stmt->bind_param('s',$id);

	if($stmt->execute()){
	    //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Customer has been deleted successfully!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'There has been an error, please try again.<pre>'.$mysqli->error.'</pre><pre>'.$query.'</pre>'
	    ));
	}

	// close connection 
	$mysqli->close();

}

?>