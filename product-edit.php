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
$query = "SELECT * FROM products WHERE product_id = '" . $mysqli->real_escape_string($getID) . "'";

$result = mysqli_query($mysqli, $query);

// mysqli select query
if($result) {
	while ($row = mysqli_fetch_assoc($result)) {
		$product_name = $row['product_name']; // product name
		$product_desc = $row['product_desc']; // product description
		$product_price = $row['product_price']; // product price
	}
}

/* close connection */
$mysqli->close();

?>

<h1>Edit Product</h1>
<hr>

<div id="response" class="alert alert-success" style="display:none;">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<div class="message"></div>
</div>
						
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Editing Rate (<?php echo $getID; ?>)</h4>
			</div>
			<div class="panel-body form-group form-group-sm">
				<form method="post" id="update_product">
					<input type="hidden" name="action" value="update_product">
					<input type="hidden" name="id" value="<?php echo $getID; ?>">
					<div class="row">
						<div class="col-xs-4">
						     <select class="form-control required select_color" name="product_name" >
						        
						        <option <?php echo $product_name=='without_color' ? 'selected' : ''; ?> value="without_color">Without Color</option>
						         <option  <?php echo $product_name=='with_color' ? 'selected' : ''; ?> value="with_color">With Color</option>
						    </select>
						
						</div>
						
						<div class="col-xs-4">
							<div class="input-group">
								<span class="input-group-addon"><?php echo CURRENCY ?></span>
								<input type="text" name="product_price" class="form-control required" placeholder="0.00" aria-describedby="sizing-addon1" value="<?php echo $product_price; ?>">
							</div>
						</div>
						<div style="<?php echo $product_name=='without_color' ? 'display
						:none' : 'display:block'; ?>" class="col-xs-4 with_color ">
							<div class="">
							    <input type="hidden" name="product_desc" value="color" />
						<span >	+</span>
								<span >40%</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 margin-top btn-group">
							<input type="submit" id="action_update_product" class="btn btn-success float-right" value="Update product" data-loading-text="Updating...">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<div>

<?php
	include('footer.php');
?>