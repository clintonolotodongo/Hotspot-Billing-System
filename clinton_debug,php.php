<?php
// Configuration
$clientId = "48734896-3877-43a1-869e-ce9ca44e70f8";
$clientSecret = "YSdk9u9LISHduCebW2wH56KnhKmXNlCNN";
$walletId = "0d143fd6-2daa-413b-a45a-43ff52975ac3"; // Live Wallet ID
$referenceNumber = "REF" . time(); // external reference number


$phone = $_POST['phone'];
$package_name = $_POST['package_name'];
$amount = 0;
$duration = '';

switch ($package_name) {
    case '12':
        $amount = 600;
        $duration = '12 Hours';
        break;
    case '24':
        $amount = 1000;
        $duration = '24 Hours';
        break;
    case '30':
        $amount = 25000;
        $duration = '30 Days';
        break;
    default:
        showErrorCard("Invalid package selected.");
        exit;
}


$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pay.iotec.io/api/payments/initiate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'ClientId: ' . $clientId,
        'ClientSecret: ' . $clientSecret,
        'WalletId: ' . $walletId  // Include the Live Wallet ID in the headers
    ),
    CURLOPT_POSTFIELDS => json_encode([
        'amount' => $amount,
        'currency' => 'UGX',
        'phone' => $phone,
        'external_reference' => $referenceNumber,
        'narration' => 'Hotspot ' . $duration . ' Package'
    ])
));

$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response, true);

if (!isset($result['status']) || $result['status'] !== 'success') {
    $errorMessage = $result['message'] ?? 'Payment initiation failed';
    showErrorCard($errorMessage);
    exit;
}

include_once("includes/config.php");
$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

if ($conn->connect_error) {
    showErrorCard("Database connection failed.");
    exit;
}

// Step 2: Fetch voucher based on uptime
$stmt = $conn->prepare("SELECT * FROM vochure WHERE uptime = ? LIMIT 1");
$stmt->bind_param("s", $uptime);
$stmt->execute();
$result = $stmt->get_result();
$voucher = $result->fetch_assoc();

if (!$voucher) {
    showErrorCard("No available voucher for this package.");
    exit;
}

$username = $voucher['username'];
$password = $voucher['password'];
$voucherId = $voucher['id'];

// Step 3: Record billing data
$stmt = $conn->prepare("INSERT INTO billing (phone, username, password, amount, uptime, external_reference) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiss", $phone, $username, $password, $amount, $uptime, $referenceNumber);
$stmt->execute();

// Step 4: Delete used voucher
$conn->query("DELETE FROM vochure WHERE id = $voucherId");
$conn->close();

// Step 5: Display voucher
function showErrorCard($message) {
    echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Error</title><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'></head><body><div class='container mt-5'><div class='card border-danger shadow'><div class='card-header bg-danger text-white text-center'><h4>Error</h4></div><div class='card-body text-center'><p class='text-danger font-weight-bold'>" . htmlspecialchars($message) . "</p><a href='wifi_portal.php' class='btn btn-secondary'>Back to Portal</a></div></div></div></body></html>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotspot Voucher</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .copy-btn {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white text-center">
                <h4>Payment Successful!</h4>
            </div>
            <div class="card-body text-center">
                <p class="lead">Your Hotspot Access Details</p>
                <div class="mb-3">
                    <strong>Username:</strong>
                    <span id="username"><?= htmlspecialchars($username) ?></span>
                    <button class="btn btn-sm btn-outline-primary copy-btn" onclick="copyText('username')">Copy</button>
                </div>
                <div class="mb-3">
                    <strong>Password:</strong>
                    <span id="password"><?= htmlspecialchars($password) ?></span>
                    <button class="btn btn-sm btn-outline-primary copy-btn" onclick="copyText('password')">Copy</button>
                </div>
                <p>Use the above credentials to login to the hotspot portal.</p>
                <a href="wifi_portal.php" class="btn btn-secondary mt-3">Back to Portal</a>
            </div>
        </div>
    </div>

    <script>
        function copyText(elementId) {
            const text = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert("Copied: " + text);
            });
        }
    </script>
</body>
</html>
