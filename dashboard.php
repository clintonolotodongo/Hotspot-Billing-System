<?php


include('header.php');
include('functions.php');
include_once("includes/config.php");

?>

<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php 
                
                $result = mysqli_query($mysqli, 'SELECT SUM(price) AS value_sum FROM billing WHERE status = "1"'); 
                $row = mysqli_fetch_assoc($result); 
                $sum = $row['value_sum'];
                echo number_format($sum,2);
                ?></h3>

              <p>Sales Amount</p>
            </div>
            <div class="icon">
              <i class="ion ion-social-usd"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php 
                
                $sql = "SELECT * FROM vochure WHERE status='0'";
                $query = $mysqli->query($sql);

                echo "$query->num_rows";
                ?></h3>

              <p>Total Vochures</p>
            </div>
            <div class="icon">
              <i class="ion ion-printer"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
      
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <h3><?php 
                
                $result = mysqli_query($mysqli, 'SELECT SUM(price) AS value_sum FROM vochure WHERE status = "0"'); 
                $row = mysqli_fetch_assoc($result); 
                $sum = $row['value_sum'];
                echo number_format($sum,2);
                ?></h3>

              <p>Amount of  Vouchers Uploaded (UGX)</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


      <!-- 2nd row -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php 
                
                $sql = "SELECT * FROM products";
                $query = $mysqli->query($sql);

                echo "$query->num_rows";
                ?></h3>

              <p>Total Packages</p>
            </div>
            <div class="icon">
              <i class="ion ion-social-dropbox"></i>
            </div>
            
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3><?php 
                
                $sql = "SELECT * FROM store_customers";
                $query = $mysqli->query($sql);

                echo "$query->num_rows";
                ?></h3>

              <p>Total Customers</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            
          </div>
        </div>

       
      </div>
      
     

    </section>
    <!-- /.content -->



<?php
	include('footer.php');
?>