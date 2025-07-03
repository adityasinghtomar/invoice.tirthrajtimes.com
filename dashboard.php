<?php

include('header.php');
include('functions.php');

?>

		<h2>Dashboard</h2>
		<hr>

		<div id="response" class="alert alert-success" style="display:none;">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<div class="message"></div>
		</div>

		<div class="row">
       

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content " style="text-align:center">
              <span class="info-box-text">Total Invoices</span>
              <span class="info-box-number"><?php echo getInvoicesCount(); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content" style="text-align:center">
              <span class="info-box-text">Total Customers</span>
              <span class="info-box-number"><?php echo getCustomersCount(); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content " style="text-align:center">
              <span class="info-box-text">Total Net Amount</span>
              <span class="info-box-number"><?php echo getNetAmount(); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
	<div class="row">
        <div class="col-xs-12">
          <!--<div class="box">
            <div class="box-header">
              <h3 class="box-title">Invoice Amount generated monthwise</h3>

            <!-- /.box-header -->
            <!--<div class="box-body table-responsive no-padding">
              <?php  getInvoicesList(); ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

	

<?php
	include('footer.php');
?>