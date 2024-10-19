<?php
session_start(); 
include '../includes/db.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set. Redirecting to login.";
    header('Location: ../login.php'); 
    exit();
} else {
    echo "User ID is: " . htmlspecialchars($_SESSION['user_id']);
}

$userId = $_SESSION['user_id']; 
?>

<body class="bg-gray-50 text-gray-800">

    <div class="relative bg-indigo-600 dark:bg-gray-900">
        <nav class="py-3.5 px-6 bg-indigo-600 dark:bg-gray-900 border-b border-solid border-indigo-400 dark:border-gray-700 fixed w-full top-0 z-20">
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

    <div class="container mx-auto mt-20 p-6">
        <h2 class="text-2xl font-bold mb-4">My Orders</h2>
        <?php
        $stmt = $conn->prepare("SELECT orders.*, products.name FROM orders JOIN products ON orders.product_id = products.id WHERE user_id = ?");

        if (!$stmt) {
            echo "Error preparing statement: " . htmlspecialchars($conn->error);
            exit();
        }

        $stmt->bind_param("i", $userId);

        if (!$stmt->execute()) {
            echo "Error executing statement: " . htmlspecialchars($stmt->error);
            exit();
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">'; 
            while ($row = $result->fetch_assoc()) {
                $formattedDate = date("M j, Y", strtotime($row['order_date']));
                
                echo '<div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">'; 
                echo '<h3 class="text-xl font-bold text-indigo-600 mb-2">Order ID: ' . htmlspecialchars($row['id']) . '</h3>'; 
                echo '<p class="text-gray-700 mb-2"><span class="font-semibold">Product:</span> ' . htmlspecialchars($row['name']) . '</p>'; 
                echo '<p class="text-gray-700 mb-2"><span class="font-semibold">Quantity:</span> ' . htmlspecialchars($row['quantity']) . '</p>'; 
                echo '<p class="text-gray-700"><span class="font-semibold">Order Date:</span> ' . htmlspecialchars($formattedDate) . '</p>'; 
                echo '</div>'; 
            }
            echo '</div>'; 
        } else {
            echo "<p class='mt-4 text-gray-600'>No orders found.</p>"; 
        }
        
        $stmt->close();
        ?>
    </div>

    <?php
    $conn->close();
    ?>
    
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
