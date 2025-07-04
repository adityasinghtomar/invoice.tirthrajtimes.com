<?php
/*******************************************************************************
* Invoice System                                            					*
*                                                                               *
* Version: 1.0                                                      	        *
* Author:  Abhishek Raj                                   						*
*******************************************************************************/

include('header.php');

?>

<h2>Add Product</h2>
<hr>

<div id="response" class="alert alert-success" style="display:none;">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<div class="message"></div>
</div>
						
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Rate Information</h4>
			</div>
			<div class="panel-body form-group form-group-sm">
				<form method="post" id="add_product">
					<input type="hidden" name="action" value="add_product">

					<div class="row">
						<div class="col-xs-3">
						    <select class="form-control required select_color" name="product_name" >
						        
						        <option value="without_color">Without Color</option>
						         <option value="with_color">With Color</option>
						    </select>
							
						</div>
					
						<div  class="col-xs-3 ">
							<div class="input-group">
								<span class="input-group-addon"><?php echo CURRENCY ?></span>
								<input type="text" name="product_price" class="form-control required" placeholder="0.00" aria-describedby="sizing-addon1">
							</div>
						</div>
						<div style="display:none" class="col-xs-4 with_color ">
							<div class="">
							    <input type="hidden" name="product_desc" value="color" />
						<span >	+</span>
								<span >40%</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 margin-top btn-group">
							<input type="submit" id="action_add_product" class="btn btn-success float-right" value="Add product" data-loading-text="Adding...">
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