<?php

include('header.php');
include('functions.php');

?>

		<h2>Create New Invoice</h2>
		<hr>

		<div id="response" class="alert alert-success" style="display:none;">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<div class="message"></div>
		</div>

		<form method="post" id="create_invoice">
			<input type="hidden" name="action" value="create_invoice">
			<div class="row">
				
			</div>
			
				<div class="row"></div>
			<div class="row">
			
					<div class="col-sm-6 col-md-4 col-xs-12 text-center">
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
				  
				   <div class="col-sm-6 col-md-4 col-xs-12 text-center">
				     <span class="">INVOICE NO.</span>
					 <div class="input-group ">
						<span class="input-group-addon">#<?php echo INVOICE_PREFIX ?></span>
						<input type="text" name="invoice_id" id="invoice_id" style="width:262px;" class="form-control required" placeholder="Invoice Number" aria-describedby="sizing-addon1" value="<?php getInvoiceId(); ?>">
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-xs-12 text-center">
				    <span class="text-left">LANGUAGE</span>
			        <div class="form-group">
			            <select name="invoice_language" class="form-control">
			                <option value="hindi" selected>Hindi (हिंदी)</option>
			                <option value="english">English</option>
			            </select>
			        </div>
			    </div>
			</div>
		
			
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="float-left">Customer Information</h4>
							<a href="#" class="float-right select-customer">Select Existing Customer</a>
							<div class="clear"></div>
						</div>
						<div class="panel-body form-group form-group-sm">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:2%;">
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
								    	<input type="text" class="form-control margin-bottom copy-input" name="gstin_no" id="gstin_no" placeholder="GSTIN NO." tabindex="5">
								    </div>
									<div class="form-group">
								    	<input type="text" class="form-control margin-bottom copy-input" name="customer_county" id="customer_county" placeholder="Country" tabindex="6">
								    </div>
								    <div class="form-group">
										<input type="text" class="form-control margin-bottom copy-input" name="customer_postcode" id="customer_postcode" placeholder="PIN Code" tabindex="7">					
									</div>
									<div class="input-group" style="margin-bottom:1%;">
										<span class="input-group-addon">@</span>
										<input type="email" class="form-control copy-input" name="customer_email" id="customer_email" placeholder="E-mail address" aria-describedby="sizing-addon1" tabindex="8">
									</div>
								    <div class="form-group">
								    	<input type="text" class="form-control margin-bottom copy-input" name="customer_phone" id="customer_phone" placeholder="Phone number" tabindex="9">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
			<!-- / end client details section -->
		<div class="css">	
			<table class="table table-bordered" id="invoice_table">
				<thead>
				    <tr><th>	<h4><a href="#" class="btn btn-success btn-xs add-row"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>&nbsp;&nbsp;Add Item</h4></th></tr>
					<tr>
						<th width="240">
						<h4>Description</h4>
						</th>
						<th>
							<h4>ReleaseOrder No.</h4>
						</th>
						<th width="200">
							<h4>Release Order Issue Date</h4>
						</th>
						<th width="180">
							<h4>Publishing Date</h4>
						</th>
						<th>
							<h4>Allotted Space Sq. Cm</h4>
						</th>
					
						<th width="150">
							<h4>Rate per Sq. Cm</h4>
						</th>
						<th>Advertisement Price</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="form-group form-group-sm  no-margin-bottom">
								<a href="#" class="btn btn-danger btn-xs delete-row"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
								<input type="text" style="width:180px;" class="form-control form-group-sm item-input invoice_product" name="invoice_product[]" placeholder="Description">
							
							</div>
						</td>
						<td class="text-right">
							<div class="form-group form-group-sm no-margin-bottom">
								<input type="text" style="width:72px;" class="form-control invoice_product_qty calculate" name="order_no[]" value="1">
							</div>
						</td>
						<td class="text-right">
							<div class="input-group datepicker" id="invoice_date" style="width:140px;">
							    <input type="text" class="form-control required datepicker" name="release_order_date[]" placeholder="release order date" data-date-format="<?php echo DATE_FORMAT ?>" />
								<span class="input-group-addon css1">
				                    <span class="glyphicon glyphicon-calendar"></span>
				                </span>
								
							</div>
						</td>
						<td class="text-right">
							<div class="input-group  datepicker" id="invoice_date" style="width:140px;">
							    <input type="text" class="form-control required datepicker" name="publishing_date[]" placeholder="Invoice date" data-date-format="<?php echo DATE_FORMAT ?>" />
								<span class="input-group-addon css1">
				                    <span class="glyphicon glyphicon-calendar"></span>
				                </span>
							
							</div>
						</td>
						<td class="text-right">
							<div class="form-group form-group-sm  no-margin-bottom">
								<input type="number" class="form-control alloted_space" name="alloted_space[]" placeholder="Value">
							</div>
						</td>
						<td class="text-right">
						    <div class="form-group form-group-sm  no-margin-bottom">
						       <?php  $rs = getRates(); ?>
						        <?php foreach(getRates() as $key=>$v): ?>
    						        <input type="hidden"  id="<?php echo $v['product_name']; ?>" name="" value="<?php echo $v['product_price']; ?>"  />
    						       
						        <?php endforeach; ?>
						        <input type="hidden"  id="" name="rate_value[]" value="<?php echo  isset( $rs[0]) ? $rs[0]['product_price'] : 0; ?>" class='rate_value'  />
								<select class="form-control rate_select" style="width:120px;" name="rate_type[]" >
								    <?php foreach(getRates() as $key=>$v): ?>
								       <option value="<?php echo $v['product_name']; ?>"><?php echo $v['product_name']; ?></option>
								     <?php endforeach; ?>
								</select>
							</div>
					     </td>
						<td class="text-right">
							<div class="form-group form-group-sm  no-margin-bottom">
								<span class="form-group ad_price">0</span>
								<input type="hidden"  class="ad_price_val" name="ad_price[]" value=""  />
							</div>
						</td>
					
					</tr>
				</tbody>
			</table></div>
			
			
			<div id="invoice_totals" class="padding-right row text-right panel panel-default">
				
				<div class="col-sm-12 col-md-12 col-xs-6 text-right">
					<div class="row">
					    
						<div class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-5 text-right">
							<strong>LESS 15% &nbsp;:</strong>&nbsp;&nbsp;
                            <span class="">Rs.&nbsp;</span><span class="less">0</span>
							<input type="hidden" name="less" id="less" value="NaN">
						</div>
						
					</div>
					<div class="row">
					  
						<div class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-5 text-right">
							<strong>GROSS AMOUNT &nbsp;:</strong>&nbsp;&nbsp;
                            <span class="">Rs.&nbsp;</span><span class="gross">0</span>
							<input type="hidden" name="gross" id="gross" value="NaN">
						</div>
						
					</div>
					<div class="row">
					    <div class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-5 text-right"><hr></div>
					    <div class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-5 text-left">
					    <select name="tax_type" id='select_tax'>
					      
					        <option value="GST">GST</option>
					    <option value="IGST">IGST</option>
					    </select>
					    
					    </div>
					    <div  class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-5 text-right gst_div">
    						    <div class="row">
    						       <div class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-6 text-right">
            							<strong>SGST @ 2.5% &nbsp;:</strong>&nbsp;&nbsp;
                                        <span class="">Rs.&nbsp;</span><span class="sgst">0</span>
            							<input type="hidden" name="sgst" id="sgst" value="NaN">
            						</div>
            						</div>
            						<div class="row">
            							<div class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-6 text-right">
            							    <strong>CGST @ 2.5% &nbsp;:</strong>&nbsp;&nbsp;
                                                <span class="">Rs.&nbsp;</span><span class="cgst">0</span>
                    							<input type="hidden" name="cgst" class='' id="cgst" value="0">
            							</div>
    							
    							</div>
    						</div>
    						<div style="display:none;" class="row igst_div">
    						<div class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-5 text-right">
    							     
            							    <strong>IGST @ 5% &nbsp;:</strong>&nbsp;&nbsp;
                                                <span class="">Rs.&nbsp;</span><span class="igst">0</span>
                    							<input type="hidden" name="igst" class='sgst' id="igst" value="0">
            						
						   </div></div>	
				</div>
					  <div class="row">
    					
    					
					
						
					         	<div class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-5 text-right" >
					         	    <hr>
					            </div>
					</div>
					
					<div class="row">
					    
						<div class="col-sm-6 col-md-6 col-xs-12 col-xs-offset-5 text-right">
							<strong>NET PAYABLE AMOUNT &nbsp;:</strong>&nbsp;&nbsp;
                            <span class="">Rs.&nbsp;</span><span class="net"> 0</span>
							<input type="hidden" name="net" id="net" value="0">
						</div>
							<div class="col-sm-6 col-md-6 col-xs-4 col-xs-offset-5 text-right">&nbsp;</div>
					</div>
					
               </div>
			</div>
				<table class="table table-bordered" id="invoice_table">
				<thead>
				    <tr><td width="150"><b>Amount In Words:</b></td><td><input type="text" name="amount_inword" class="form-control required" id="num_words" readonly="true"></td></tr>
				    </table>
				    
			<div class="row">	
			    <!--<div class="col-xs-12">
					<div class="input-group form-group-sm textarea no-margin-bottom">
						<textarea class-"form-control" name="invoice_notes" placeholder="Please enter any order notes here."></textarea>
					</div>
				</div>-->
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