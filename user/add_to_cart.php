<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php'); 
    exit();
}

$user_id = $_SESSION['user_id']; 

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); 

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc(); 

    $orderStmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $quantity = 1; 

    $orderStmt->bind_param("iii", $user_id, $product_id, $quantity);

    if ($orderStmt->execute()) {
        $message = "Product added to cart successfully.";
        $order_success = true;
    } else {
        $message = "Error: " . $orderStmt->error; 
        $order_success = false;
    }

    $orderStmt->close();
} else {
    $message = "No product ID specified.";
    $order_success = false;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.3/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.3/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center h-screen">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md text-center">
        <h2 class="text-2xl font-semibold mb-4"><i class="fas fa-shopping-cart"></i> Order Summary</h2>
        <p class="text-lg mb-4"><?php echo htmlspecialchars($message); ?></p>

        <?php if (isset($product)): ?>
            <div class="mb-4">
                <h3 class="text-xl font-semibold">Product Details</h3>
                <div class="border p-4 rounded-lg mt-2">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($product['name']); ?></p>
                    <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                    <p><strong>Quantity:</strong> 1</p>
                </div>
            </div>
        <?php endif; ?>

        

        <div class="mt-4">
            <a href="view_products.php" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition duration-300">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
        </div>
    </div>
</body>
</html>
