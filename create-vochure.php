<?php 
include('header.php');
include('functions.php');
?>

<h2>Created <span class="invoice_type">Packages</span></h2>

<div class="row" style="margin-top: 30px;">
    
    <!-- Package 1 -->
    <div class="col-xs-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">12 Hours Package</h4>
            </div>
            <div class="panel-body">
                <p><strong>Duration:</strong> 12 hours</p>
                <p><strong>Price:</strong> UGX 600</p>
                <p><strong>Speed:</strong> Auto</p>
                <p><strong>Access:</strong> Single Device</p>
                <hr>
                <form method="post" action="upload_csv.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="csv_file_12">Upload CSV:</label>
                        <input type="file" name="csv_file" id="csv_file_12" class="form-control" required>
                     
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Package 2 -->
    <div class="col-xs-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title">24 Hours Package</h4>
            </div>
            <div class="panel-body">
                <p><strong>Duration:</strong> 1 Day</p>
                <p><strong>Price:</strong> UGX 1000</p>
                <p><strong>Speed:</strong> Auto</p>
                <p><strong>Access:</strong> Single Device</p>
                <hr>
                <form method="post" action="upload_csv.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="csv_file_24">Upload CSV:</label>
                        <input type="file" name="csv_file" id="csv_file_24" class="form-control" required>
                       
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Package 3 -->
    <div class="col-xs-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">30 Days Package</h4>
            </div>
            <div class="panel-body">
                <p><strong>Duration:</strong> 30 Days</p>
                <p><strong>Price:</strong> UGX 25,000</p>
                <p><strong>Speed:</strong> Unlimited</p>
                <p><strong>Access:</strong> Single Device</p>
                <hr>
                <form method="post" action="upload_csv.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="csv_file_30">Upload CSV:</label>
                        <input type="file" name="csv_file" id="csv_file_30" class="form-control" required>
                       
                    </div>
                    <button type="submit" class="btn btn-info btn-sm">Upload</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include('footer.php'); ?>
