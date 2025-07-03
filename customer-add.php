<?php

include('header.php');

?>

<h1>Add Customer</h1>
<hr>

<div id="response" class="alert alert-success" style="display:none;">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
<div class="message"></div>
</div>

<form method="post" id="create_customer">
	<input type="hidden" name="action" value="create_customer">
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Customer Information</h4>
					<div class="clear"></div>
				</div>
				<div class="panel-body form-group form-group-sm">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="customer_name" id="customer_name" placeholder="Enter Name" tabindex="1">
							</div>
							<div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="customer_address_1" id="customer_address_1" placeholder="Address Line 1" tabindex="2">	
							</div>
							<div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="customer_address_2" id="customer_address_2" placeholder="Address Line 2" tabindex="3">	
							</div>
							<div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="customer_town" id="customer_town" placeholder="City" tabindex="4">		
							</div>
								<div class="form-group">
								<input type="text" class="form-control margin-bottom copy-input required" name="gstin_no" id="gstin_no" placeholder="GSTIN NO. " tabindex="5">	
							</div>
						</div>
						<div class="col-sm-6">
							
							    <div class="form-group">
								<input type="text" class="form-control copy-input " name="customer_postcode" id="customer_postcode" placeholder="PIN Code" tabindex="6">					
							</div>
							<div class="form-group">
						    	<input type="text" class="form-control  copy-input " name="customer_county" id="customer_county" placeholder="Country" tabindex="7">
						    </div>
						    <div class="form-group">
								<input type="email" class="form-control copy-input " name="customer_email" id="customer_email" placeholder="E-mail Address" aria-describedby="sizing-addon1" tabindex="8">
							</div>
						    <div class="form-group">
						    	<input type="text" class="form-control copy-input " name="customer_phone" id="invoice_phone" placeholder="Phone Number" tabindex="9">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	</div>
	<div class="row">
		<div class="col-sm-12 margin-top btn-group">
			<input type="submit" id="action_create_customer" class="btn btn-success float-right" value="Create Customer" data-loading-text="Creating...">
		</div>
	</div>
</form>

<?php
	include('footer.php');
?>