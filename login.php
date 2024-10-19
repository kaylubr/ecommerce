<?php
session_start();
include 'includes/db.php';

$error_message = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username']; 
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['role'] = $user['role']; 
            
            if ($user['role'] == 'admin') {
                header('Location: admin/index.php');
            } else {
                header('Location: user/index.php');
            }
            exit();
        } else {
            $error_message = "Invalid password."; 
        }
    } else {
        $error_message = "User not found."; 
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</head>
<body class="flex h-screen bg-gray-100">

    <div class="w-1/2 flex items-center justify-center p-8">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            
            <?php if ($error_message): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-600 focus:outline-none">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-600 focus:outline-none">
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Login</button>
            </form>
            <p class="mt-4 text-center text-gray-600">Don't have an account? <a href="register.php" class="text-blue-600 hover:underline">Register here</a>.</p>
        </div>
    </div>

    <div class="w-1/2 hidden md:flex items-center justify-center">
    <div class="h-full w-full relative">
        <img src="https://plus.unsplash.com/premium_photo-1683984171269-04c84ee23234?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="E-commerce" class="object-cover w-full h-full">
       
    </div>
</div>

</body>
</html>
