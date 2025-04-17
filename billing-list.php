<?php 
include('header.php');
include('functions.php');

// Assuming a function getConnectedClients() exists that fetches data from your database
?>

<h1>Connected Clients</h1>
<hr>

<div class="row">
	
	<div class="col-xs-12">
		<div id="response" class="alert alert-success" style="display:none;">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<div class="message"></div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Connected Client Information</h4>
			</div>
			<div class="panel-body form-group form-group-sm">
				
				<?php
				// Fetch connected clients' details from the database
				// Assuming getConnectedClients() fetches client data
				$clients = getConnectedClients();
				
				// Calculate the sum of the prices
				$totalPrice = 0;
				foreach ($clients as $client) {
					$totalPrice += $client['price']; // Assuming 'price' is a numeric value
				}
				?>

				<!-- Display the total price above the table -->
				<div class="alert alert-info">
					<strong>Total Price:</strong> <?php echo number_format($totalPrice, 2); ?>
				</div>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Date</th>
							<th>Price</th>
							<th>Package</th>
							<th>Phone Number</th>
							<th>Status</th>
							<th>Method</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($clients as $client) {
							echo "<tr>";
							echo "<td>" . htmlspecialchars($client['date']) . "</td>";
							echo "<td>" . htmlspecialchars($client['price']) . "</td>";
							echo "<td>" . htmlspecialchars($client['package']) . "</td>";
							echo "<td>" . htmlspecialchars($client['phone_number']) . "</td>";
							echo "<td>" . htmlspecialchars($client['status']) . "</td>";
							echo "<td>" . htmlspecialchars($client['method']) . "</td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>

			</div>
		</div>
	</div>

</div>

<div id="confirm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete product</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this product?</p>
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
