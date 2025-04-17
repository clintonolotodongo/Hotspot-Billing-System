<?php


include_once("includes/config.php");

// get invoice list
function getInvoices() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
    $query = "SELECT * 
		FROM invoices i
		JOIN customers c
		ON c.invoice = i.invoice
		WHERE i.invoice = c.invoice
		ORDER BY i.invoice";

	// mysqli select query
	$results = $mysqli->query($query);

	// mysqli select query
	if($results) {

		print '<table class="table table-striped table-hover table-bordered" id="data-table" cellspacing="0"><thead><tr>

				<th>Invoice</th>
				<th>Customer</th>
				<th>Issue Date</th>
				<th>Due Date</th>
				<th>Type</th>
				<th>Status</th>
				<th>Actions</th>

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

			print '
				<tr>
					<td>'.$row["invoice"].'</td>
					<td>'.$row["name"].'</td>
				    <td>'.$row["invoice_date"].'</td>
				    <td>'.$row["invoice_due_date"].'</td>
				    <td>'.$row["invoice_type"].'</td>
				';

				if($row['status'] == "open"){
					print '<td><span class="label label-primary">'.$row['status'].'</span></td>';
				} elseif ($row['status'] == "paid"){
					print '<td><span class="label label-success">'.$row['status'].'</span></td>';
				}

			print '
				    <td><a href="invoice-edit.php?id='.$row["invoice"].'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a href="#" data-invoice-id="'.$row['invoice'].'" data-email="'.$row['email'].'" data-invoice-type="'.$row['invoice_type'].'" data-custom-email="'.$row['custom_email'].'" class="btn btn-success btn-xs email-invoice"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a> <a href="invoices/'.$row["invoice"].'.pdf" class="btn btn-info btn-xs" target="_blank"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a> <a data-invoice-id="'.$row['invoice'].'" class="btn btn-danger btn-xs delete-invoice"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
			    </tr>
			';

		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no invoices to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();

}

// Initial invoice number
function getInvoiceId() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$query = "SELECT invoice FROM invoices ORDER BY invoice DESC LIMIT 1";

	if ($result = $mysqli->query($query)) {

		$row_cnt = $result->num_rows;

	    $row = mysqli_fetch_assoc($result);

	    //var_dump($row);

	    if($row_cnt == 0){
			echo INVOICE_INITIAL_VALUE;
		} else {
			echo $row['invoice'] + 1; 
		}

	    // Frees the memory associated with a result
		$result->free();

		// close connection 
		$mysqli->close();
	}
	
}
function deleteVouchersByUptime12() {

    // Connect to the database
    $mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

    // output any connection error
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }

    // Query to delete vouchers with uptime = '12'
    $query = "DELETE FROM vochure WHERE uptime = '12'";

    // Execute the query
    if ($mysqli->query($query)) {
        echo "<script>alert('Vouchers with uptime 12 have been deleted.');</script>";
    } else {
        echo "<script>alert('Failed to delete vouchers.');</script>";
    }

    // Close the database connection
    $mysqli->close();
}
function deleteVouchersByUptime24() {

    // Connect to the database
    $mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

    // output any connection error
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }

    // Query to delete vouchers with uptime = '12'
    $query = "DELETE FROM vochure WHERE uptime = '24'";

    // Execute the query
    if ($mysqli->query($query)) {
        echo "<script>alert('Vouchers with uptime 12 have been deleted.');</script>";
    } else {
        echo "<script>alert('Failed to delete vouchers.');</script>";
    }

    // Close the database connection
    $mysqli->close();
}

function deleteVouchersByUptime30() {

    // Connect to the database
    $mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

    // output any connection error
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }

    // Query to delete vouchers with uptime = '12'
    $query = "DELETE FROM vochure WHERE uptime = '24'";

    // Execute the query
    if ($mysqli->query($query)) {
        echo "<script>alert('Vouchers with uptime 12 have been deleted.');</script>";
    } else {
        echo "<script>alert('Failed to delete vouchers.');</script>";
    }

    // Close the database connection
    $mysqli->close();
}


// populate product dropdown for invoice creation
function popProductsList() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM products ORDER BY product_name ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {
		echo '<select class="form-control item-select">';
		while($row = $results->fetch_assoc()) {

		    print '<option value="'.$row['product_price'].'">'.$row["product_name"].' - '.$row["product_desc"].'</option>';
		}
		echo '</select>';

	} else {

		echo "<p>There are no products, please add a product.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();

}

// populate product dropdown for invoice creation
function popCustomersList() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM store_customers ORDER BY name ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-hover table-bordered" id="data-table"><thead><tr>

				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Action</th>

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["name"].'</td>
				    <td>'.$row["email"].'</td>
				    <td>'.$row["phone"].'</td>
				    <td><a href="#" class="btn btn-primary btn-xs customer-select" data-customer-name="'.$row['name'].'" data-customer-email="'.$row['email'].'" data-customer-phone="'.$row['phone'].'" data-customer-address-1="'.$row['address_1'].'" data-customer-address_2="'.$row['address_2'].'" data-customer-town="'.$row['town'].'" data-customer-county="'.$row['county'].'" data-customer-postcode="'.$row['postcode'].'" data-customer-name-ship="'.$row['name_ship'].'" data-customer-address-1-ship="'.$row['address_1_ship'].'" data-customer-address-2-ship="'.$row['address_2_ship'].'" data-customer-town-ship="'.$row['town_ship'].'" data-customer-county-ship="'.$row['county_ship'].'" data-customer-postcode-ship="'.$row['postcode_ship'].'">Select</a></td>
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no customers to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();

}

// get products list
function getProducts() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM products ORDER BY product_name ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-hover table-bordered" id="data-table"><thead><tr>

				<th>Product</th>
				<th>Description</th>
				<th>Price</th>
				<th>Action</th>

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["product_name"].'</td>
				    <td>'.$row["product_desc"].'</td>
				    <td>$'.$row["product_price"].'</td>
				    <td><a href="product-edit.php?id='.$row["product_id"].'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-product-id="'.$row['product_id'].'" class="btn btn-danger btn-xs delete-product"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no products to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();
}

//getBilling


//get12Hours
function get12hours() {
    // Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
		// the query
		$query = "SELECT * FROM vochure WHERE  uptime ='12'";

		// mysqli select query
		$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-hover table-bordered" id="data-table"><thead><tr>

				<th>username</th>
				<th>password</th>
				<th>Price</th>
				

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["username"].'</td>
				    <td>'.$row["password"].'</td>
				    <td>UGX'.$row["price"].'</td>
				   
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no products to display.</p>";

	}
}
//get12Hours
function get24hours() {
    // Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
		// the query
		$query = "SELECT * FROM vochure WHERE  uptime ='24'";

		// mysqli select query
		$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-hover table-bordered" id="data-table"><thead><tr>

				<th>username</th>
				<th>password</th>
				<th>Price</th>
				

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["username"].'</td>
				    <td>'.$row["password"].'</td>
				    <td>UGX'.$row["price"].'</td>
				   
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no products to display.</p>";

	}
}
//get12Hours
function get30Days() {
    // Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
		// the query
		$query = "SELECT * FROM vochure WHERE  uptime ='30'";

		// mysqli select query
		$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-hover table-bordered" id="data-table"><thead><tr>

				<th>username</th>
				<th>password</th>
				<th>Price</th>
				

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["username"].'</td>
				    <td>'.$row["password"].'</td>
				    <td>UGX'.$row["price"].'</td>
				   
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no products to display.</p>";

	}
}

function getSold() {
    // Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
		// the query
		$query = "SELECT * FROM vochure WHERE  status ='1'";

		// mysqli select query
		$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-hover table-bordered" id="data-table"><thead><tr>

				<th>username</th>
				<th>password</th>
				<th>Price</th>
				

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["username"].'</td>
				    <td>'.$row["password"].'</td>
				    <td>UGX'.$row["price"].'</td>
				   
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no products to display.</p>";

	}
}


function getConnectedClients() {
    // Connect to the database
    $mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

    // Output any connection error
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }

    // The query to fetch connected client data
    $query = "SELECT * FROM billing ORDER BY date DESC";

    // Perform the query
    $results = $mysqli->query($query);

    // Check if there are results
    if ($results) {
        $clients = [];  // Initialize an empty array to store client data

        // Loop through the results and populate the array
        while ($row = $results->fetch_assoc()) {
            $clients[] = [
                'date' => $row["date"],
                'price' => $row["price"],
                'package' => $row["package"],
                'phone_number' => $row["phone"],  // Add this field if it's available
                'status' => $row["status"],              // Add this field if it's available
                'method' => $row["method"]               // Add this field if it's available
            ];
        }

        // Free the result set
        $results->free();

        // Close the database connection
        $mysqli->close();

        return $clients;  // Return the array of client data
    } else {
        // Handle query failure (no clients found)
        echo "<p>There are no clients to display.</p>";

        // Close the connection
        $mysqli->close();

        return null;  // Return null if no clients are found
    }
}



// get user list
function getUsers() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM users ORDER BY username ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-hover table-bordered" id="data-table"><thead><tr>

				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Action</th>

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
			    	<td>'.$row['name'].'</td>
					<td>'.$row["username"].'</td>
				    <td>'.$row["email"].'</td>
				    <td>'.$row["phone"].'</td>
				    <td><a href="user-edit.php?id='.$row["id"].'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-user-id="'.$row['id'].'" class="btn btn-danger btn-xs delete-user"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no users to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();
}

// get user list
function getCustomers() {

	// Connect to the database
	$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

	// output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	// the query
	$query = "SELECT * FROM store_customers ORDER BY name ASC";

	// mysqli select query
	$results = $mysqli->query($query);

	if($results) {

		print '<table class="table table-striped table-hover table-bordered" id="data-table"><thead><tr>

				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Action</th>

			  </tr></thead><tbody>';

		while($row = $results->fetch_assoc()) {

		    print '
			    <tr>
					<td>'.$row["name"].'</td>
				    <td>'.$row["email"].'</td>
				    <td>'.$row["phone"].'</td>
				    <td><a href="customer-edit.php?id='.$row["id"].'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a data-customer-id="'.$row['id'].'" class="btn btn-danger btn-xs delete-customer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
			    </tr>
		    ';
		}

		print '</tr></tbody></table>';

	} else {

		echo "<p>There are no customers to display.</p>";

	}

	// Frees the memory associated with a result
	$results->free();

	// close connection 
	$mysqli->close();
}

?>

