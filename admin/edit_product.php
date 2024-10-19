<?php
session_start();
include '../includes/db.php';

$productId = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$productId";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $sql = "UPDATE products SET name='$name', description='$description', price=$price, stock=$stock WHERE id=$productId";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_products.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800 p-0">

    <div class="relative bg-indigo-600 dark:bg-gray-900">
        <nav class="py-3.5 px-6 bg-indigo-600 dark:bg-gray-900 border-b border-solid border-indigo-400 dark:border-gray-700 fixed w-full top-0 z-20">
            <div class="flex items-center justify-between gap-1 sm:gap-6 lg:flex-row flex-col">
                <div class="flex justify-between items-center lg:w-auto w-full">
                    <a href="#" class="block text-white font-bold text-2xl">
                        E-commerce System
                    </a>
                    <button id="navbar-toggle" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div id="mobile-navbar" class="hidden lg:flex flex-row w-full flex-1 shadow-sm lg:shadow-none lg:bg-transparent rounded-xl py-4 lg:py-0">
                    <ul class="text-center flex lg:flex-row flex-col xl:gap-1 gap-2 lg:ml-auto lg:flex lg:bg-indigo-500 dark:bg-transparent items-center p-1 rounded-xl">
                        <li><a href="dashboard.php" class="py-2 px-5 flex justify-center bg-white transition-all duration-500 ease-in-out text-xs text-gray-900 font-semibold rounded-lg">Dashboard</a></li>
                        <li><a href="view_orders.php" class="py-2 px-5 bg-transparent transition-all duration-500 ease-in-out text-xs text-white hover:bg-white hover:text-gray-900 font-semibold rounded-lg flex justify-center">View Orders</a></li>
                        <li><a href="view_products.php" class="py-2 px-5 bg-transparent transition-all duration-500 ease-in-out text-xs text-white hover:bg-white hover:text-gray-900 font-semibold rounded-lg flex justify-center">View Products</a></li>
                    </ul>
                    <div class="text-center lg:flex items-center gap-1 sm:gap-4 lg:ml-auto">
                        <div class="flex justify-center py-2 px-2 text-white transition-all duration-300 rounded-lg items-center whitespace-nowrap gap-2">
                            <span class="hidden lg:block">Hello, <?php echo htmlspecialchars($_SESSION['user']); ?> (<?php echo htmlspecialchars($_SESSION['role']); ?>)</span>
                        </div>
                        <a href="../logout.php" class="flex justify-center py-2 px-2 bg-white hover:bg-indigo-50 text-gray-600 transition-all duration-300 rounded-lg items-center whitespace-nowrap gap-2">
                            <span class="hidden lg:block">Logout</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m0 0l7 7m-7-7l7-7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <main class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg mt-24">
        <h2 class="text-2xl font-semibold mb-6 flex items-center">
            <i class="fas fa-pencil-alt mr-2 text-indigo-600"></i>
            Edit Product
        </h2>

        <?php if (isset($error)): ?>
            <div class="bg-red-200 text-red-800 p-4 rounded-md mb-4"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($product['name']); ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($product['price']); ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200">
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stock" id="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200">
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition duration-200 flex items-center justify-center">
                <i class="fas fa-save mr-2"></i> Update Product
            </button>
        </form>
    </main>
</body>
</html>
