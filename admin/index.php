<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <header class="bg-indigo-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            <nav class="flex items-center space-x-4">
                <span class="text-lg font-medium">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></span>
                <a href="../logout.php" class="bg-white text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-50 transition-all">
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto my-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Manage Products</h2>
            <a href="add_product.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition-all">
                Add New Product
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold text-indigo-600">Add Product</h3>
                <p class="text-gray-600 mt-2">Create a new product for the store.</p>
                <a href="add_product.php" class="inline-block mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition-all">
                    Add Product
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold text-indigo-600">View Orders</h3>
                <p class="text-gray-600 mt-2">Manage and track customer orders.</p>
                <a href="view_orders.php" class="inline-block mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition-all">
                    View Orders
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold text-indigo-600">View Products</h3>
                <p class="text-gray-600 mt-2">Manage and delete your products.</p>
                <a href="view_products.php" class="inline-block mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition-all">
                    View Products
                </a>
            </div>
        </div>
    </main>

    

    <script src="https://unpkg.com/flowbite@1.5.0/dist/flowbite.js"></script>
</body>
</html>
