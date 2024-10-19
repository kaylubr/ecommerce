<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
include '../includes/db.php';

function formatDate($date) {
    return date('Y-m-d', strtotime($date));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.5.0/dist/flowbite.js"></script>
</head>
<body class="bg-gray-100">

    <header class="bg-indigo-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16m-7 4h7m-7 4h7" />
                </svg>
                E-commerce Admin Dashboard
            </h1>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <a href="../logout.php" class="flex items-center hover:text-indigo-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3" />
                            </svg>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto my-8 px-4">
        <h2 class="text-2xl font-semibold text-center mb-6">Orders List</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<div class='bg-white shadow-lg rounded-lg p-6 flex flex-col justify-between transition-transform transform hover:scale-105'>
                        <div class='flex flex-col mb-4'>
                           
                            <div class='flex items-center mb-2'>
                                <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6 text-indigo-600 mr-2' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 17h5l-1.403 2.205A2 2 0 0116 20H4a2 2 0 01-2-2V8a2 2 0 012-2h11a2 2 0 012 2v5' />
                                </svg>
                                <span class='font-semibold mr-1'>User ID:</span> <span class='text-gray-700'>{$row['user_id']}</span>
                            </div>  
                            <div class='flex items-center mb-2'>
                                <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6 text-indigo-600 mr-2' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3h-2v6H9v-6H7l3-3V8h2z' />
                                </svg>
                                <span class='font-semibold mr-1'>Product ID:</span> <span class='text-gray-700'>{$row['product_id']}</span>
                            </div>
                            <div class='flex items-center mb-2'>
                                <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6 text-indigo-600 mr-2' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 6v12m6-6H6' />
                                </svg>
                                <span class='font-semibold mr-1'>Quantity:</span> <span class='text-gray-700'>{$row['quantity']}</span>
                            </div>
                            <div class='flex items-center mb-2'>
                                <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6 text-indigo-600 mr-2' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 12V4a2 2 0 00-2-2H4a2 2 0 00-2 2v16a2 2 0 002 2h10a2 2 0 002-2v-8l6 4V8l-6 4z' />
                                </svg>
                                <span class='font-semibold mr-1'>Order Date:</span> <span class='text-gray-700'>" . formatDate($row['order_date']) . "</span>
                            </div>
                        </div>
                    </div>";
            }
            ?>
        </div>

        <div class="mt-8 text-center">
            <a href="index.php" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">Go Back</a>
        </div>
    </main>

</body>
</html>
