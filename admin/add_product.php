<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO products (name, description, price, stock) VALUES ('$name', '$description', '$price', '$stock')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>Product added successfully. Redirecting...</div>";
        header("refresh:2;url=index.php"); 
    } else {
        echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

     <header class="bg-indigo-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            <nav class="flex items-center space-x-4">
                <span class="text-lg">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></span>
                <a href="../logout.php" class="bg-white text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-50 transition-all">
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <h1 class="text-2xl font-bold text-center mt-8">Add Product</h1>

    <main class="container mx-auto my-8 px-4">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Product Details</h2>

            <form method="POST" action="" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full p-2.5 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter product name" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Product Description</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full p-2.5 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter product description" required></textarea>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price" step="0.01" class="mt-1 block w-full p-2.5 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter product price" required>
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                    <input type="number" id="stock" name="stock" class="mt-1 block w-full p-2.5 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter stock quantity" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition-all">
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </main>

  

    <script src="https://unpkg.com/flowbite@1.5.0/dist/flowbite.js"></script>
</body>
</html>
