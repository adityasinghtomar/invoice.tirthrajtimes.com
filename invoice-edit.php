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
$query = "SELECT p.*, i.*, c.*
			FROM invoice_items p 
			JOIN invoices i ON i.invoice = p.invoice
			JOIN customers c ON c.invoice = i.invoice
			WHERE p.invoice = '" . $mysqli->real_escape_string($getID) . "'";

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

		// invoice details
		$invoice_number = $row['invoice']; // invoice number
		$custom_email = $row['custom_email']; // invoice custom email body
		$invoice_date = $row['invoice_date']; // invoice date
		$invoice_due_date = $row['invoice_due_date']; // invoice due date
		$invoice_subtotal = $row['subtotal']; // invoice sub-total
		$invoice_shipping = $row['shipping']; // invoice shipping amount
		$invoice_discount = $row['discount']; // invoice discount
		$invoice_vat = $row['vat']; // invoice vat
		$invoice_total =0; // invoice total
		$invoice_notes = $row['notes']; // Invoice notes
		$invoice_type = $row['invoice_type']; // Invoice type
		$invoice_status = $row['status']; // Invoice status
		
		$less = $row['less'];
		$gross = $row['gross'];
		$net = $row['net'];
		$tax = $row['vat'];
	
		$tax_type = $row['tax_type'];
		
		$sgst = $tax_type=='GST' ? $tax/2 : 0;
		$igst = empty($sgst) ? $tax: 0;
		$amount_inword = $row['amount_inword'];
		$notes = $row['notes'];
		$invoice_language = isset($row['language']) ? $row['language'] : 'hindi'; // Default to Hindi if not set
	
	}
}

/* close connection */
$mysqli->close();

?>

<?php 

						// Connect to the database
						$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

						// output any connection error
						if ($mysqli->connect_error) {
							die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
						}

						// the query
						$query2 = "SELECT * FROM invoice_items WHERE invoice = '" . $mysqli->real_escape_string($getID) . "'";

						$result2 = mysqli_query($mysqli, $query2);

						//var_dump($result2);

						// mysqli select query
						
					?>
	<h1>Edit Invoice (<?php echo $getID; ?>)</h1>
	
		<hr>

		<div id="response" class="alert alert-success" style="display:none;">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<div class="message"></div>
		</div>

		<form method="post" id="create_invoice">
			<input type="hidden" name="action" value="create_invoice">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-xs-12">
					<textarea name="custom_email" id="custom_email" class="custom_email_textarea" placeholder="Enter a custom email message here if you wish to override the default invoice type email message."></textarea>
				</div>
			</div>
			
				<div class="row"></div>
			<div class="row">
			
				<div class="col-sm-6 col-md-6 col-xs-6">
					
					<div class="col-sm-6 col-md-6 col-xs-12 text-left">
					    <span class="text-left">INVOICE DATE</span>
				        <div class="form-group">
				            <div class="input-group date" id="invoice_date">
				                <input type="text" class="form-control required" name="invoice_date" placeholder="Invoice date" data-date-format="<?php echo DATE_FORMAT ?>" />
				                <span class="input-group-addon">
				                    <span class="glyphicon glyphicon-calendar"></span>
				                </span>
				            </div>
				        </div>
				    </div>
				  </div>
				   <div class="col-sm-3 col-md-3 col-xs-12">
				     <span class="">INVOICE NO.</span>
					 <div class="input-group col-xs-4 float-center">
						<span class="input-group-addon">#<?php echo INVOICE_PREFIX ?></span>
						<input type="text" name="invoice_id" id="invoice_id" style="width:162px;" class="form-control required" placeholder="Invoice Number" aria-describedby="sizing-addon1" value="<?php getInvoiceId(); ?>">
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-xs-12 text-center">
					<div class="input-group col-xs-4 float-center">
						<span class="">GSTIN NO:</span>
						<input type="text" name="GSTNO" id="invoice_id" class="form-control required" placeholder="Invoice Number" aria-describedby="sizing-addon1" value="<?php getInvoiceId(); ?>">
					</div>
				</div>

				<div class="col-sm-3 col-md-3 col-xs-12 text-center">
				    <span class="text-left">LANGUAGE</span>
			        <div class="form-group">
			            <select name="invoice_language" class="form-control">
			                <option value="hindi" <?php echo ($invoice_language == 'hindi') ? 'selected' : ''; ?>>Hindi (हिंदी)</option>
			                <option value="english" <?php echo ($invoice_language == 'english') ? 'selected' : ''; ?>>English</option>
			            </select>
			        </div>
			    </div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="float-left">Customer Information</h4>
							<a href="#" class="float-right select-customer">Select existing customer</a>
							<div class="clear"></div>
						</div>
						<div class="panel-body form-group form-group-sm">
							<div class="row">
								<div class="col-md-12 col-xs-6" style="margin-bottom:2%;">
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customer_name" id="customer_name" placeholder="Enter name" tabindex="1">
									</div>
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customer_address_1" id="customer_address_1" placeholder="Address 1" tabindex="3">	
									</div>
									 <div class="form-group">
								    	<input type="text" class="form-control margin-bottom copy-input" name="customer_address_2" id="customer_address_2" placeholder="Address 2" tabindex="4">
								    </div>
									<div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input required" name="customer_town" id="customer_town" placeholder="Town" tabindex="5">		
									</div>
									<div class="form-group ">
										<input type="text" class="form-control copy-input required" name="customer_postcode" id="customer_postcode" placeholder="Postcode" tabindex="7">					
									</div>
								</div>
								<div class="col-md-12 col-xs-6">
									
								   
								    <div class="form-group">
								    	<input type="text" class="form-control margin-bottom copy-input required" name="customer_county" id="customer_county" placeholder="County" tabindex="6">
								    </div>
								    <div class="input-group " style="margin-bottom:2%;">
										<span class="input-group-addon">@</span>
										<input type="email" class="form-control copy-input required" name="customer_email" id="customer_email" placeholder="E-mail address" aria-describedby="sizing-addon1" tabindex="2">
									</div>
								    <div class="form-group no-margin-bottom">
								    	<input type="text" class="form-control required" name="customer_phone" id="customer_phone" placeholder="Phone number" tabindex="8">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
			<!-- / end client details section -->
			<table class="table table-bordered" id="invoice_table">
				<thead>
				    <tr><th>	<h4><a href="#" class="btn btn-success btn-xs add-row"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>&nbsp;&nbsp;Add Item</h4></th></tr>
					<tr>
						<th width="240">
						<h4>Description</h4>
						</th>
						<th>
							<h4>Release
Order No.</h4>
						</th>
						<th width="200">
							<h4>Release
Order Issue
Date</h4>
						</th>
						<th width="180">
							<h4>Publishing
Date</h4>
						</th>
						<th>
							<h4>Allotted
Space
Sq. Cm</h4>
						</th>
					
						<th width="150">
							<h4>Rate per
Sq. Cm</h4>
						</th>
						<th>Advertiseme
nt
Price</th>
					</tr>
				</thead>
				<tbody>
				    <?php
				
				    if($result2) {
							while ($rows = mysqli_fetch_assoc($result2)) {
                              

							    $item_product = $rows['product'];
							    $order_no = $rows['order_no'];
							    $publishing_date = $rows['publishing_date'];
							    $alloted_space = $rows['alloted_space'];
							    $release_order_date = $rows['release_order_date'];
							    $ad_price = $rows['ad_price'];
							    $rate_value = $rows['rate_value'];
							    $rate_type = $rows['rate_type'];
							      
		            ?>
					<tr>
						<td>
							<div class="form-group form-group-sm  no-margin-bottom">
								<a href="#" class="btn btn-danger btn-xs delete-row"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
								<input type="text" style="width:180px;" value="<?php echo $item_product; ?>" class="form-control form-group-sm item-input invoice_product" name="invoice_product[]" placeholder="Description">
							
							</div>
						</td>
						<td class="text-right">
							<div class="form-group form-group-sm no-margin-bottom">
								<input type="text" style="width:72px;" class="form-control invoice_product_qty calculate" name="order_no[]" value="<?php echo $order_no; ?>">
							</div>
						</td>
						<td class="text-right">
							<div class="input-group input-group-sm  no-margin-bottom datepicker" id="invoice_date">
							    <input type="text" class="form-control required datepicker"  value="<?php echo $release_order_date; ?>" name="release_order_date[]" placeholder="release order date" data-date-format="<?php echo DATE_FORMAT ?>" />
								<span class="input-group-addon">
				                    <span class="glyphicon glyphicon-calendar"></span>
				                </span>
								
							</div>
						</td>
						<td class="text-right">
							<div class="input-group input-group-sm  no-margin-bottom datepicker" id="invoice_date">
							    <input type="text" class="form-control required datepicker" value="<?php echo $publishing_date; ?>" name="publishing_date[]" placeholder="Invoice date" data-date-format="<?php echo DATE_FORMAT ?>" />
								<span class="input-group-addon">
				                    <span class="glyphicon glyphicon-calendar"></span>
				                </span>
							
							</div>
						</td>
						<td class="text-right">
							<div class="form-group form-group-sm  no-margin-bottom">
								<input type="number" class="form-control alloted_space" value="<?php echo $alloted_space; ?>"  name="alloted_space[]" placeholder="Value">
							</div>
						</td>
						<td class="text-right">
						    <div class="form-group form-group-sm  no-margin-bottom">
						       <?php  $rs = getRates(); ?>
						        <?php foreach(getRates() as $key=>$v): ?>
    						        <input type="hidden"  id="<?php echo $v['product_name']; ?>" name="" value="<?php echo $v['product_price']; ?>"  />
    						       
						        <?php endforeach; ?>
						        <input type="hidden"  id="" name="rate_value[]" value="<?php echo $rate_value; ?>" class='rate_value'  />
								<select class="form-control rate_select" style="width:120px;" name="rate_type[]" >
								    <?php foreach(getRates() as $key=>$v): ?>
								       <option <?php echo $rate_type==$v['product_name'] ? 'selected' : ''; ?> value="<?php echo $v['product_name']; ?>"><?php echo $v['product_name']; ?></option>
								     <?php endforeach; ?>
								</select>
							</div>
					     </td>
						<td class="text-right">
							<div class="form-group form-group-sm  no-margin-bottom">
								<span class="form-group ad_price">0</span>
								<input type="hidden"  class="ad_price_val" name="ad_price[]" value="<?php echo $ad_price; ?>"  />
							</div>
						</td>
					
					</tr>
					<?php }   } ?>
				</tbody>
			</table>
			<div id="invoice_totals" class="padding-right row text-right panel panel-default">
				
				<div class="col-sm-12 col-md-12 col-xs-6 text-right">
					<div class="row">
					    
						<div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-right">
							<strong>LESS 15% &nbsp;:</strong>&nbsp;&nbsp;
                            <span class="">Rs.&nbsp;</span><span class="less"><?php echo $less; ?></span>
							<input type="hidden" name="less" id="less" value="<?php echo $less; ?>">
						</div>
						
					</div>
					<div class="row">
					  
						<div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-right">
							<strong>GROSS AMOUNT &nbsp;:</strong>&nbsp;&nbsp;
                            <span class="">Rs.&nbsp;</span><span class="gross"><?php echo $gross; ?></span>
							<input type="hidden" name="gross" id="gross" value="<?php echo $gross; ?>">
						</div>
						
					</div>
					<div class="row">
					    <div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-right"><hr></div>
					    <div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-left">
					    <select name="tax_type" id='select_tax'>
					      
					        <option <?php echo $tax_type=='GST' ? 'selected':''; ?> value="GST">GST</option>
					    <option <?php echo $tax_type=='IGST' ? 'selected':''; ?> value="IGST">IGST</option>
					    </select>
					    
					    </div>
					    <div style="<?php echo $tax_type=='IGST' ? 'display:none;':''; ?>"  class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-right gst_div">
    						    <div class="row">
    						       <div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-6 text-right">
            							<strong>SGST @ 2.5% &nbsp;:</strong>&nbsp;&nbsp;
                                        <span class="">Rs.&nbsp;</span><span class="sgst"><?php echo $sgst; ?></span>
            							<input type="hidden" name="sgst" id="sgst" value="<?php echo $sgst; ?>">
            						</div>
            						</div>
            						<div class="row">
            							<div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-6 text-right">
            							    <strong>CGST @ 2.5% &nbsp;:</strong>&nbsp;&nbsp;
                                                <span class="">Rs.&nbsp;</span><span class="cgst"><?php echo $sgst; ?></span>
                    							<input type="hidden" name="cgst" class='' id="cgst" value="<?php echo $sgst; ?>">
            							</div>
    							
    							</div>
    						</div>
    						<div style="<?php echo $tax_type=='IGST' ? 'display:block;':'display:none;'; ?>" class="row igst_div">
    						<div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-right">
    							     
            							    <strong>IGST @ 5% &nbsp;:</strong>&nbsp;&nbsp;
                                                <span class="">Rs.&nbsp;</span><span class="igst"><?php echo $igst; ?></span>
                    							<input type="hidden" name="igst" class='sgst' id="igst" value="<?php echo $igst; ?>">
            						
						   </div></div>	
				</div>
					  <div class="row">
    					
    					
					
						
					         	<div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-right" >
					         	    <hr>
					            </div>
					</div>
					
					<div class="row">
					    
						<div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-right">
							<strong>NET PAYABLE AMOUNT &nbsp;:</strong>&nbsp;&nbsp;
                            <span class="">Rs.&nbsp;</span><span class="net"> <?php echo $net; ?></span>
							<input type="hidden" name="net" id="net" value="<?php echo $net; ?>">
						</div>
							<div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-right">&nbsp;</div>
					</div>
					
               </div>
			</div>
				<table class="table table-bordered" id="invoice_table">
				<thead>
				    <tr><td width="150"><b>Amount In Words:</b></td><td><input value="<?php echo $amount_inword; ?>" type="text" name="amount_inword" class="form-control required" id="num_words" readonly="true"></td></tr>
				    </table>
				    
			<div class="row">	
			    <div class="col-xs-6">
					<div class="input-group form-group-sm textarea no-margin-bottom">
						<textarea class-"form-control" <?php echo $notes; ?> name="invoice_notes" placeholder="Please enter any order notes here."></textarea>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-xs-12 margin-top btn-group">
					<input type="submit" id="action_create_invoice" class="btn btn-success float-right" value="Create Invoice" data-loading-text="Creating...">
				</div>
			</div>
		</form>

		<div id="insert" class="modal fade">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Select an item</h4>
		      </div>
		      <div class="modal-body">
				<?php popProductsList(); ?>
		      </div>
		      <div class="modal-footer">
		        <button type="button" data-dismiss="modal" class="btn btn-primary" id="selected">Add</button>
				<button type="button" data-dismiss="modal" class="btn">Cancel</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div id="insert_customer" class="modal fade">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Select an existing customer</h4>
		      </div>
		      <div class="modal-body">
				<?php popCustomersList(); ?>
		      </div>
		      <div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">Cancel</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

<?php
	include('footer.php');
?>
