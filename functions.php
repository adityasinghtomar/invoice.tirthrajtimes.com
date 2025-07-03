<?php


include_once("includes/config.php");

// get invoice list

function getInvoicesCount() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
    $query = "SELECT * 
		FROM invoices i
		JOIN customers c
		ON c.invoice = i.invoice
		WHERE i.invoice = c.invoice
		ORDER BY i.invoice";

	// mysqli select query
	$results = $mysqli->query($query);
   return 	$results->num_rows;
}

function getNetAmount() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
    $query = "SELECT SUM(net) as net 
		FROM invoices i
		INNER JOIN customers c
		ON c.invoice = i.invoice 
		WHERE i.invoice = c.invoice
		ORDER BY i.invoice";

	// mysqli select query
	$results = $mysqli->query($query);
	$name = $results->fetch_assoc();;
   return  isset($name['net']) ? $name['net'] : 0;
}

function getInvoices($GET) {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
	}

$q = '';
/*if(isset($GET['min']) && isset($GET['max'])){
    $q = " and i.invoice_date between '".$GET['min']."' and '".$GET['max']."'";
}*/
if(isset($_GET['min']) && isset($_GET['max'])){
//	$min = date('Y-m-d',strtotime($_GET['min']));
	 $mindate = date_create(str_replace("/","-",$_GET['min']));	
     $min = date_format($mindate,"Y-m-d");
	
	$date = date_create(str_replace("/","-",$_GET['max']));	
	$max = date_format($date,"Y-m-d");

    $q = " and i.invoice_date between '".$min."' and '".$max."'";
}


	// the query
//   $query = "SELECT * 
// 		FROM invoices i
// 		INNER JOIN customers c
// 		ON c.invoice = i.invoice 
// 		WHERE i.invoice = c.invoice ".$q."
// 		ORDER BY i.invoice";  
      $query = "SELECT * 
		FROM invoices i
		INNER JOIN customers c
		ON c.invoice = i.invoice 
		WHERE i.invoice = c.invoice ".$q."
		ORDER BY i.id DESC";

	// mysqli select query
	$results = $mysqli->query($query);

	// mysqli select query
	if($results) {
        
		print '<table class="table table-striped table-bordered word-wrap" id="data-table" cellspacing="0"><thead><tr>
                	<th><h4>Sr.No</h4></th>
				<th><h4>Customer Name</h4></th>
					<th><h4>Customer GSTIN No.</h4></th>
				<th><h4>Invoice Date</h4></th>
					<th><h4>Invoice Number</h4></th>
			
				<th><h4>Gross Amount</h4></th>
				<th><h4>CGST</h4></th>
				<th><h4>SGST</h4></th>
				<th><h4>IGST</h4></th>
				<th><h4>Payable Amount</h4></th>
				<th style="width: 10%"><h4>Action</h4></th>

			  </tr></thead><tbody>';
$i=1;
		while($row = $results->fetch_assoc()) {
		  $id = $row["id"];
         $cgst = $row["tax_type"]=='GST' ? floatval($row['vat']/2) : 0; 
         $igst = $row["tax_type"]=='GST' ? 0: $row['vat'];
			print '
				<tr>
				<td>'.$i.'</td>
				<td>'.$row["name"].'</td>
				<td>'.$row["GSTN"].'</td>
						
					<td>'.$row["invoice_date"].'</td>
					<td>'.$row["invoice"].'/TRT/25-26</td>
						
								<td>'.$row["gross"].'</td>
									<td>'.$cgst.'</td>
								
					<td>'.$cgst.'</td>
				    <td>'.$igst.'</td>
				    <td>'.$row["net"].'</td>
				   
				';

//<a href="invoice-edit.php?id='.$row["invoice"].'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
			print '
				    <td> <a href="#" data-invoice-id="'.$row['invoice'].'" data-email="'.$row['email'].'" data-invoice-type="'.$row['invoice_type'].'" data-custom-email="'.$row['custom_email'].'" class="btn btn-success btn-xs email-invoice"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a> <a href="invoices/'.$row["name"].$id.'.pdf" class="btn btn-info btn-xs" target="_blank"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>  <a href="invoices/'.$row["name"].$id.'-2'.'.pdf" class="btn btn-info btn-xs back" target="_blank"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a> <a data-invoice-id="'.$row['invoice'].'" class="btn btn-danger btn-xs delete-invoice"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
			    </tr>
			';
$i++;
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no invoices to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();

}


function getRates() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
    $query = "SELECT * 
		FROM products ";

	// mysqli select query
	$results = $mysqli->query($query);
	return $results->fetch_all(MYSQLI_ASSOC);
}

function getInvoicesList() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
    $query = "SELECT * 
		FROM invoices i
		JOIN customers c
		ON c.invoice = i.invoice
		WHERE i.invoice = c.invoice
		ORDER BY i.invoice";

	// mysqli select query
	$results = $mysqli->query($query);

	// mysqli select query
	if($results) {

		print '<table class="table table-striped table-bordered display" id="data-table" cellspacing="0"><thead><tr>

				<th><h4>Sr. No.</h4></th>
				<th><h4>Amount</h4></th>
				<th><h4>Month</h4></th>
			

			  </tr></thead><tbody>';
			  $arr = [];
			 
			  foreach($results->fetch_all(MYSQLI_ASSOC) as $key=>$row) {
			     $m =  date('M-Y',strtotime($row["invoice_date"]));
			     if(isset($arr[$m])){
			         if($row['net']){
			            $arr[$m] =  $arr[$m]+floatval($row['net']);
			         }
			     } else{
			         if($row['net']){    
			           $arr[$m] = floatval($row['net']);;
			         }
			     }
			     
			  }
   $i=0;
       
		foreach($arr as $key=>$v) {
          $i = $i+1;
			print '
				<tr>
					<td>'.$i.'</td>
					<td>'.$v.'</td>
				    <td>'.$key.'</td>
				    
				';

			
			    print'</tr>
			';

		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no invoices to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();

}

// Initial invoice number
function getInvoiceId() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$query = "SELECT id,invoice FROM invoices ORDER BY id DESC LIMIT 1";

	if ($result = $mysqli->query($query)) {

		$row_cnt = $result->num_rows;

	    $row = mysqli_fetch_assoc($result);

	    //var_dump($row);

	    if($row_cnt == 0){
			echo INVOICE_INITIAL_VALUE;
		} else {
			echo $row['id'] + 1; 
		}

	    // Frees the memory associated with a result
		$result->free();

		// close connection 
		$mysqli->close();
	}

	
}

// populate product dropdown for invoice creation
function popProductsList() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM products ORDER BY product_name ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {
		echo '<select class="form-control item-select">';
		while($row = $results->fetch_assoc()) {

		    print '<option value="'.$row['product_price'].'">'.$row["product_name"].' - '.$row["product_desc"].'</option>';
		}
		echo '</select>';

	} else {

		echo "<p>There are no products, please add a product.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();

}

// populate product dropdown for invoice creation
function popCustomersList() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM store_customers ORDER BY name ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-bordered" id="data-table"><thead><tr>

				<th><h4>Name</h4></th>
				<th><h4>Email</h4></th>
				<th><h4>Phone</h4></th>
				<th><h4>Action</h4></th>

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["name"].'</td>
				    <td>'.$row["email"].'</td>
				    <td>'.$row["phone"].'</td>
				    <td><a href="#" class="btn btn-primary btn-xs customer-select" data-customer-name="'.$row['name'].'" data-customer-email="'.$row['email'].'"  data-customer-phone="'.$row['phone'].'" data-gstin_no="'.$row['gstin_no'].'" data-customer-address-1="'.$row['address_1'].'" data-customer-address_2="'.$row['address_2'].'" data-customer-town="'.$row['town'].'" data-customer-county="'.$row['county'].'" data-customer-postcode="'.$row['postcode'].'" data-customer-name-ship="'.$row['name_ship'].'" data-customer-address-1-ship="'.$row['address_1_ship'].'" data-customer-address-2-ship="'.$row['address_2_ship'].'" data-customer-town-ship="'.$row['town_ship'].'" data-customer-county-ship="'.$row['county_ship'].'" data-customer-postcode-ship="'.$row['postcode_ship'].'">Select</a></td>
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no customers to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();

}

// get products list
function getProducts() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM products ORDER BY product_name ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-bordered" id="data-table"><thead><tr>

				<th><h4>Product</h4></th>
				<th><h4>Description</h4></th>
				<th><h4>Price</h4></th>
				<th><h4>Action</h4></th>

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["product_name"].'</td>
				    <td>'.$row["product_desc"].'</td>
				    <td>'.$row["product_price"].'</td>
				    <td><a href="product-edit.php?id='.$row["product_id"].'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-product-id="'.$row['product_id'].'" class="btn btn-danger btn-xs delete-product"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no products to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();
}

// get user list
function getUsers() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM users ORDER BY username ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-bordered" id="data-table"><thead><tr>

				<th><h4>Name</h4></th>
				<th><h4>Username</h4></th>
				<th><h4>Email</h4></th>
				<th><h4>Phone</h4></th>
				<th><h4>Action</h4></th>

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
			    	<td>'.$row['name'].'</td>
					<td>'.$row["username"].'</td>
				    <td>'.$row["email"].'</td>
				    <td>'.$row["phone"].'</td>
				    <td><a href="user-edit.php?id='.$row["id"].'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-user-id="'.$row['id'].'" class="btn btn-danger btn-xs delete-user"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no users to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();
}

// get user list
function getCustomersCount() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM store_customers ORDER BY name ASC";

	// mysqli select query
	$results = $mysqli->query($query);
return $results->num_rows;

}
// get user list
function getCustomers() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM store_customers ORDER BY name ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-bordered" id="data-table"><thead><tr>

				<th><h4>Name</h4></th>
				<th><h4>Email</h4></th>
				<th><h4>Phone</h4></th>
				<th><h4>Action</h4></th>

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["name"].'</td>
				    <td>'.$row["email"].'</td>
				    <td>'.$row["phone"].'</td>
				    <td><a href="customer-edit.php?id='.$row["id"].'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-customer-id="'.$row['id'].'" class="btn btn-danger btn-xs delete-customer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no customers to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();
}

?>

