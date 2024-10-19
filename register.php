<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = $_POST['role']; 

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
        exit(); 
    } else {
        $errorMessage = "<div class='bg-red-200 text-red-800 p-4 rounded mb-4 text-center w-full'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body class="flex h-screen bg-gray-100">

    <div class="w-full flex items-center justify-center p-8">
        <div class="relative w-1/2 flex items-center justify-center flex-col">
            <?php
            if (isset($errorMessage)) {
                echo $errorMessage;
            }
            ?>

            <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md transition duration-300 ease-in-out">
                <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Create an Account</h2>

                <form method="POST" action="">
                    <div class="mb-4 relative">
                        <label for="username" class="block text-gray-700">Username</label>
                        <div class="flex items-center border border-gray-300 rounded-md focus:ring focus:ring-blue-600 focus:outline-none">
                            <i class="fas fa-user absolute left-3 text-gray-500"></i>
                            <input type="text" name="username" id="username" placeholder="Enter your username" required class="mt-1 block w-full px-10 py-2">
                        </div>
                    </div>

                    <div class="mb-6 relative">
                        <label for="password" class="block text-gray-700">Password</label>
                        <div class="flex items-center border border-gray-300 rounded-md focus:ring focus:ring-blue-600 focus:outline-none">
                            <i class="fas fa-lock absolute left-3 text-gray-500"></i>
                            <input type="password" name="password" id="password" placeholder="Enter your password" required class="mt-1 block w-full px-10 py-2">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-gray-700">Select Role:</label>
                        <select name="role" id="role" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-600 focus:outline-none">
                            <option value="user">Regular User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                        <i class="fas fa-user-plus mr-2"></i> Register
                    </button>
                </form>
                <p class="mt-4 text-center text-gray-600">Already have an account? <a href="login.php" class="text-blue-600 hover:underline">Login here</a>.</p>
            </div>
        </div>
    </div>

    <div class="w-1/2 hidden md:flex items-center justify-center bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="bg-black bg-opacity-50 h-full w-full flex items-center justify-center">
            <h1 class="text-white text-4xl font-bold">Join Our Community!</h1>
        </div>
    </div>

</body>
</html>