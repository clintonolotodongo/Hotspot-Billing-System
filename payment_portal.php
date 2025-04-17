<?php 
include('portal_header.php');
include('functions.php');
?>

<h2 class="text-center">Available <span class="invoice_type">Hotspot Packages</span></h2>

<div class="container" style="margin-top: 30px;">
    <div class="row">

        <!-- 12 Hours Package -->
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">12 Hours Package</h4>
                </div>
                <div class="panel-body">
                    <p><strong>Duration:</strong> 12 Hours</p>
                    <p><strong>Speed:</strong> Auto</p>
                    <p><strong>Data Cap:</strong> Unlimited</p>
                    <p><strong>Access:</strong> 1 Device</p>
                    <p><strong>Price:</strong> UGX 600</p>
                    <hr>
                    <form method="post" action="initiate_payment.php">
                        <input type="hidden" name="package_name" value="12 Hours">
                        <input type="hidden" name="price" value="600">
                        <input type="hidden" name="validity" value="12h">
                        <input type="hidden" name="speed" value="Auto">
                        <input type="hidden" name="device_limit" value="1">
                        <input type="hidden" name="data_cap" value="Unlimited">

                        <div class="form-group">
                            <label for="phone_12">Phone Number:</label>
                            <input type="number" name="phone" id="phone_12" class="form-control" placeholder="e.g. 25677xxxxxxx" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Initiate Payment</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 24 Hours Package -->
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title">24 Hours Package</h4>
                </div>
                <div class="panel-body">
                    <p><strong>Duration:</strong> 1 Day</p>
                    <p><strong>Speed:</strong> Auto</p>
                    <p><strong>Data Cap:</strong> Unlimited</p>
                    <p><strong>Access:</strong> 1 Device</p>
                    <p><strong>Price:</strong> UGX 1000</p>
                    <hr>
                    <form method="post" action="initiate_payment.php">
                        <input type="hidden" name="package_name" value="24 Hours">
                        <input type="hidden" name="price" value="1000">
                        <input type="hidden" name="validity" value="24h">
                        <input type="hidden" name="speed" value="Auto">
                        <input type="hidden" name="device_limit" value="1">
                        <input type="hidden" name="data_cap" value="Unlimited">

                        <div class="form-group">
                            <label for="phone_24">Phone Number:</label>
                            <input type="number" name="phone" id="phone_24" class="form-control" placeholder="e.g. 25677xxxxxxx" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm btn-block">Initiate Payment</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 30 Days Package -->
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">30 Days Package</h4>
                </div>
                <div class="panel-body">
                    <p><strong>Duration:</strong> 30 Days</p>
                    <p><strong>Speed:</strong> Auto</p>
                    <p><strong>Data Cap:</strong> Unlimited</p>
                    <p><strong>Access:</strong> 1 Device</p>
                    <p><strong>Price:</strong> UGX 25,000</p>
                    <hr>
                    <form method="post" action="initiate_payment.php">
                        <input type="hidden" name="package_name" value="30 Days">
                        <input type="hidden" name="price" value="25000">
                        <input type="hidden" name="validity" value="30d">
                        <input type="hidden" name="speed" value="Auto">
                        <input type="hidden" name="device_limit" value="1">
                        <input type="hidden" name="data_cap" value="Unlimited">

                        <div class="form-group">
                            <label for="phone_30">Phone Number:</label>
                            <input type="number" name="phone" id="phone_30" class="form-control" placeholder="e.g. 25677xxxxxxx" required>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm btn-block">Initiate Payment</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Payment Info -->
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12">
            <div class="alert alert-primary text-center">
                <strong>Note:</strong> We accept both <strong>MTN</strong> and <strong>Airtel</strong> payments.<br>
                Make sure you have sufficient balance including transaction charges before you proceed.
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
