<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $sql = "DELETE FROM products WHERE id=$productId";

    if ($conn->query($sql) === TRUE) {
        $message = "Product deleted successfully.";
        $error = false;
    } else {
        $message = "Error: " . $conn->error;
        $error = true;
    }
} else {
    $message = "No product ID provided.";
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center h-screen">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md text-center">
        <h2 class="text-2xl font-semibold mb-4"><?php echo htmlspecialchars($error ? 'Error!' : 'Success!'); ?></h2>
        <p class="text-lg mb-4"><?php echo htmlspecialchars($message); ?></p>
        
        <div class="mt-4">
            <div id="countdown" class="text-2xl font-bold text-indigo-600">3</div>
        </div>

        <div class="mt-6">
            <a href="view_products.php" class="text-indigo-600 hover:underline">View Products Now</a>
        </div>
    </div>

    <script>
        let countdown = 3;
        const countdownElement = document.getElementById('countdown');
        
        const interval = setInterval(() => {
            countdown--;
            countdownElement.innerText = countdown;

            if (countdown <= 0) {
                clearInterval(interval);
                window.location.href = 'view_products.php';
            }
        }, 1000);
    </script>
</body>
</html>
