<?php


include('header.php');
include('functions.php');

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>

<h1>Invoice List</h1>
<hr>

<div class="row">

	<div class="col-xs-12">

		<div id="response" class="alert alert-success" style="display:none;">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<div class="message"></div>
		</div>
	
		<div class="panel panel-default">
		   
			<div class="panel-heading">
				<h4>Manage Invoices</h4>
			</div>
			
		        <form method="get" action="">
        			<div class="col-sm-12 filters-groups">
        			<h4>Invoice Date Filter</h4>
        				<div class="row">
        				    <div class="col-sm-4 ">
        				        <div class="form-group">
        				         <div class="input-group date" id="invoice_date">
        		                 	From : <input class="form-control required" data-date-format="<?php echo DATE_FORMAT ?>" name="min" id="date-min" type="text"><span style="border: 0px;" class="input-group-addon">
				                    <span class="glyphicon glyphicon-calendar"></span>
				                </span></div></div></div><div class="form-group">
        	                    	<div class="col-sm-4 ">
        	                    	     <div class="input-group date" id="invoice_date">
        	                    	    	To : <input class="form-control required" data-date-format="<?php echo DATE_FORMAT ?>" name="max" id="date-max" type="text"><span style="border: 0px;" class="input-group-addon">
				                    <span class="glyphicon glyphicon-calendar"></span>
				                </span></div></div></div>
        	                    	
        	                    	<div class="col-sm-4 "><input   type="submit" value="Filter" /></div>
        			
        			    </div>
        			</div></form>
			
			<div class="panel-body form-group form-group-sm table-responsive">
			    
			    
				<?php getInvoices($_GET); ?>
			</div>
		</div>
	</div>
<div>

<div id="delete_invoice" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Invoice</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this invoice?</p>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
		<button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
	include('footer.php');
?>