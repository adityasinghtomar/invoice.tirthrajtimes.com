<?php


include('header.php');
include('functions.php');

$getID = $_GET['id'];

// Connect to the database
$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

// output any connection error
if ($mysqli->connect_error) {
	die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
}

// the query
$query = "SELECT * FROM store_customers WHERE id = '" . $mysqli->real_escape_string($getID) . "'";

$result = mysqli_query($mysqli, $query);

// mysqli select query
if($result) {
	while ($row = mysqli_fetch_assoc($result)) {

		$customer_name = $row['name']; // customer name
		$customer_email = $row['email']; // customer email
		$customer_address_1 = $row['address_1']; // customer address
		$customer_address_2 = $row['address_2']; // customer address
		$customer_town = $row['town']; // customer town
		$customer_county = $row['county']; // customer county
		$customer_postcode = $row['postcode']; // customer postcode
		$customer_phone = $row['phone']; // customer phone number
		
		//shipping
		$customer_name_ship = $row['name_ship']; // customer name (shipping)
		$customer_address_1_ship = $row['address_1_ship']; // customer address (shipping)
		$customer_address_2_ship = $row['address_2_ship']; // customer address (shipping)
		$customer_town_ship = $row['town_ship']; // customer town (shipping)
		$customer_county_ship = $row['county_ship']; // customer county (shipping)
		$customer_postcode_ship = $row['postcode_ship']; // customer postcode (shipping)
	    $gstin_no = $row['gstin_no'];
	    
	}
}

/* close connection */
$mysqli->close();

?>

<h1>Edit Customer</h1>
<hr>

<div id="response" class="alert alert-success" style="display:none;">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<div class="message"></div>
</div>

<form method="post" id="update_customer">
	<input type="hidden" name="action" value="update_customer">
	<input type="hidden" name="id" value="<?php echo $getID; ?>">
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Editing Customer (<?php echo $getID; ?>)</h4>
					<div class="clear"></div>
				</div>
				<div class="panel-body form-group form-group-sm">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="customer_name" id="customer_name" placeholder="Enter name" tabindex="1" value="<?php echo $customer_name; ?>">
							</div>
							<div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="customer_address_1" id="customer_address_1" placeholder="Address Line 1" tabindex="2" value="<?php echo $customer_address_1; ?>">	
							</div>
							<div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="customer_address_2" id="customer_address_2" placeholder="Address Line 2" tabindex="3" value="<?php echo $customer_address_2; ?>">	
							</div>
							<div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="customer_town" id="customer_town" placeholder="City" tabindex="4" value="<?php echo $customer_town; ?>">		
							</div>
							<div class="form-group no-margin-bottom">
								<input type="text" class="form-control margin-bottom copy-input required" name="gstin_no" id="gstin_no" placeholder="GSTIN NO." tabindex="5" value="<?php echo $gstin_no; ?>">				
							</div>
						</div>
						<div class="col-sm-6">
							<div class="input-group float-right margin-bottom">
								<span class="input-group-addon">@</span>
								<input type="email" class="form-control copy-input required" name="customer_email" id="customer_email" placeholder="E-mail address" aria-describedby="sizing-addon1" tabindex="6" value="<?php echo $customer_email; ?>">
							</div>
							<div class="form-group">
						    	<input type="text" class="form-control required" name="customer_phone" id="invoice_phone" placeholder="Phone Number" tabindex="7" value="<?php echo $customer_phone; ?>">
							</div>
						    <div class="form-group">
								<input type="text" class="form-control copy-input required" name="customer_postcode" id="customer_postcode" placeholder="PIN Code" tabindex="8" value="<?php echo $customer_postcode; ?>">	
							</div>
						    <div class="form-group no-margin-bottom">
						    	<input type="text" class="form-control margin-bottom copy-input required" name="customer_county" id="customer_county" placeholder="Country" tabindex="9" value="<?php echo $customer_county; ?>">
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="row">
		<div class="col-sm-12 margin-top btn-group">
			<input type="submit" id="action_update_customer" class="btn btn-success float-right" value="Update Customer" data-loading-text="Updating...">
		</div>
	</div>
</form>

<?php
	include('footer.php');
?>