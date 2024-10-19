<?php
session_start();

if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['user', 'admin'])) {
    header('Location: ../login.php'); 
    exit();
}

$host = 'localhost';
$db = 'ecommerce_db';
$user = 'root'; 
$pass = '2005'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="relative bg-indigo-600 dark:bg-gray-900">
        <nav class="py-4 px-6 bg-indigo-600 dark:bg-gray-900 border-b border-solid border-indigo-400 dark:border-gray-700 fixed w-full top-0 z-20">
            <div class="flex items-center justify-between gap-1 sm:gap-6 lg:flex-row flex-col">
                <div class="flex justify-between items-center lg:w-auto w-full">
                    <a href="#" class="block text-white font-bold text-2xl">
                        E-commerce System
                    </a>
                    <button id="navbar-toggle" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none" aria-controls="navbar-default" aria-expanded="false">
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
                            <span class="hidden lg:block font-medium">Hello, <?php echo htmlspecialchars($_SESSION['user']); ?> (<?php echo htmlspecialchars($_SESSION['role']); ?>)</span>
                        </div>
                        <a href="../logout.php" class="flex justify-center py-2 px-3.5 bg-white hover:bg-indigo-50 text-gray-600 transition-all duration-300 rounded-lg items-center whitespace-nowrap gap-2">
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

    <div class="pt-20">
        <div class="text-center mb-8 bg-blue-500 text-white py-8">
            <h1 class="text-3xl font-bold">Welcome to Your User Dashboard</h1>
            <p class="mt-4 text-gray-100">Manage your profile, view your orders, and explore our product offerings.</p>
        </div>

         <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 mx-10">
            <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center justify-center transition-shadow hover:shadow-xl">
                <i class="fas fa-box-open fa-3x text-indigo-600 mb-4"></i>
                <h2 class="text-xl font-semibold">View Your Orders</h2>
                <p class="text-center text-gray-600 mt-2">Manage and track your orders efficiently.</p>
                <a href="view_orders.php" class="mt-4 bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-500 transition-colors">Go to Orders</a>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center justify-center transition-shadow hover:shadow-xl">
                <i class="fas fa-th-list fa-3x text-indigo-600 mb-4"></i>
                <h2 class="text-xl font-semibold">Browse Products</h2>
                <p class="text-center text-gray-600 mt-2">Explore our product offerings and add to your cart.</p>
                <a href="view_products.php" class="mt-4 bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-500 transition-colors">Shop Now</a>
            </div>
        </div>

<div id="products" class="mt-10 mx-10">
    <h2 class="text-2xl font-bold text-indigo-600 mb-4">Recent Products</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 3"; 
        $result = $conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='bg-white shadow-lg rounded-lg p-4 flex flex-col justify-between transition-shadow hover:shadow-xl'>
                <h3 class='text-lg font-semibold text-gray-800'>{$row['name']}</h3>
                <p class='text-gray-600'>{$row['description']}</p>
                <p class='mt-2 font-bold text-lg text-indigo-600'>\${$row['price']}</p>
                <a href='add_to_cart.php?id={$row['id']}' class='mt-4 bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-500 transition-colors text-center'>Add to Cart</a>
            </div>";
        }
        ?>
    </div>
</div>

    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.3/flowbite.min.js"></script>
    <script>
        const navbarToggle = document.getElementById('navbar-toggle');
        const mobileNavbar = document.getElementById('mobile-navbar');

        navbarToggle.addEventListener('click', () => {
            mobileNavbar.classList.toggle('hidden');
        });
    </script>
</body>
</html>
