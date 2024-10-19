<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-blue-600">E-commerce System</a>
            <div class="space-x-6 flex">
                <a href="login.php" class="flex items-center text-gray-600 hover:text-blue-600 transition duration-300">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                </a>
                <a href="register.php" class="flex items-center text-gray-600 hover:text-blue-600 transition duration-300">
                    <i class="fas fa-user-plus mr-1"></i> Create Account
                </a>
            </div>
        </div>
    </nav>

    <header class="flex items-center justify-center align-center bg-blue-600 text-white h-90 gap-8 px-20">
        <div class="container mx-auto px-4 py-20 text-left">
            <h1 class="text-5xl font-bold mb-4">Welcome to Our E-commerce System</h1>
            <p class="mb-8 text-lg">Your one-stop shop for all your needs. Explore our collection now!</p>
            <a href="login.php" class="inline-block py-3 px-6 bg-white text-blue-600 font-semibold rounded-lg shadow hover:bg-gray-200 transition duration-300">Get Started</a>
        </div>
        <img src="hero-image.png" alt="Hero Image" class="w-50 h-auto object-cover" />
    </header>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg text-center transition-transform transform hover:scale-105">
                    <i class="fas fa-shopping-cart text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Easy Shopping</h3>
                    <p>Browse and shop your favorite items easily with our user-friendly interface.</p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg text-center transition-transform transform hover:scale-105">
                    <i class="fas fa-shipping-fast text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Fast Delivery</h3>
                    <p>Enjoy quick and reliable delivery services right to your doorstep.</p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg text-center transition-transform transform hover:scale-105">
                    <i class="fas fa-lock text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Secure Payments</h3>
                    <p>Your transactions are safe with us, ensuring your data is protected.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white py-4 text-center">
        <p class="text-gray-500">&copy; 2024 E-commerce System. All rights reserved.</p>
    </footer>

</body>
</html>
