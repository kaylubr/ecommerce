<?php
session_start();
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Products</title>
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

    <main class="container mx-auto mt-24 my-8 py-16">
        <h2 class="text-2xl font-semibold mb-4">Available Products</h2>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div class="mb-4 md:mb-0">
                <input type="text" id="search" placeholder="Search products..." class="w-full md:w-64 p-2 border rounded-lg" onkeyup="filterProducts()">
            </div>
            <div class="flex space-x-4">
    <select id="priceFilter" class="p-2 border rounded-lg" onchange="filterProducts()">
        <option value="">All Prices</option>
        <option value="low"><i class="fas fa-arrow-down"></i> Low to High</option>
        <option value="high"><i class="fas fa-arrow-up"></i> High to Low</option>
    </select>
</div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="productContainer">
            <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300'>
                    <h3 class='text-xl font-semibold text-indigo-600 mb-2'>" . htmlspecialchars($row['name']) . "</h3>
                    <p class='text-gray-700 mb-2'>" . htmlspecialchars($row['description']) . "</p>
                    <p class='text-gray-900 font-bold mb-4'>\$" . htmlspecialchars($row['price']) . "</p>
                    <a href='add_to_cart.php?id=" . htmlspecialchars($row['id']) . "' class='inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition-all'>
                        <i class='fas fa-cart-plus'></i> Add to Cart
                    </a>
                </div>";
            }
            ?>
        </div>
    </main>

    

    <script>
        function filterProducts() {
    const searchInput = document.getElementById('search').value.toLowerCase();
    const priceFilter = document.getElementById('priceFilter').value;
    const products = Array.from(document.querySelectorAll('#productContainer > div'));

    let filteredProducts = products.filter(product => {
        const productName = product.querySelector('h3').textContent.toLowerCase();
        return productName.indexOf(searchInput) !== -1;
    });

    filteredProducts.sort((a, b) => {
        const priceA = parseFloat(a.querySelector('.font-bold').textContent.replace('$', ''));
        const priceB = parseFloat(b.querySelector('.font-bold').textContent.replace('$', ''));

        if (priceFilter === 'low') {
            return priceA - priceB; 
        } else if (priceFilter === 'high') {
            return priceB - priceA; 
        }
        return 0;
    });

    const productContainer = document.getElementById('productContainer');
    productContainer.innerHTML = ''; 
    filteredProducts.forEach(product => {
        productContainer.appendChild(product); 
    });
}
    </script>
</body>
</html>
