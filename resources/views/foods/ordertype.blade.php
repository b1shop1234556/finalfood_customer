<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center p">

    <!-- Header -->
    <nav class="bg-blue-100 w-full p-4 shadow-md flex justify-between items-center text-white">
        <h1 class="text-2xl text-red-500 font-bold ml-2">Welcome</h1>
        <div class="flex space-x-2">
            <!-- <a href="{{ url('/order') }}" class="bg-red-500 px-2 py-1 rounded-lg font-semibold flex items-center">
            Order History
            </a>
            <a href="/" class="bg-yellow-400 px-2 py-1 rounded-lg font-semibold flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 2a1 1 0 00-.707.293l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h4a1 1 0 001-1v-4h2v4a1 1 0 001 1h4a1 1 0 001-1v-6.586l1.293 1.293a1 1 0 001.414-1.414l-7-7A1 1 0 0010 2z" fill="black" />
            </svg>
            </a> -->
        </div>
        <!-- <button class="bg-yellow-400 px-2 py-1 rounded-lg font-semibold">Order History</button>
        <button class="bg-yellow-400 px-2 py-1 rounded-lg font-semibold">Order History</button> -->
    </nav>

    <!-- Hero Section -->
    <section class="text-center mt-1 bg-red-500 text-white p-12 w-full max-w-8xl">
        <h2 class="text-4xl font-semibold mb-6 font-bold">Where will you be eating?</h2>
        <!-- <p class="text-xl font-semibold mb-6">Have your Jollibee favorites delivered right to your doorstep!</p> -->
        <!-- <a  href="{{ url('/menu') }}" class="bg-yellow-500 mt-6 px-6 py-3 rounded-full font-semibold text-white hover:bg-red-700 transition duration-300">Order Now</a> -->
    </section>

    <!-- Exclusive Bundles Section -->
    <div id="exclusive-bundles" class="mt-12 text-center w-full">
        <!-- <h3 class="text-3xl font-semibold mb-8">Where will you be eating?</h3> -->
        <div class="flex justify-center space-x-6 px-4">
            <div class="bg-white p-6 rounded-lg text-center transition duration-300 hover:scale-105 transform">
                <img src="/dinein.png" alt="Dine In" class="w-full h-full object-cover rounded-md mb-4">
                <h3 class="font-semibold text-xl mb-2">Dine In</h3>
                <!-- <p class="text-blue-600 font-bold mb-2">Enjoy your meal in our cozy restaurant.</p> -->
                <a href="{{ url('/order') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">Choose Dine In</a>
            </div>
            <div class="bg-white p-6 rounded-lg text-center transition duration-300 hover:scale-105 transform">
                <img src="/takeout.png" alt="Take Out" class="w-full h-full object-cover rounded-md mb-4">
                <h3 class="font-semibold text-xl mb-2">Take Out</h3>
                <!-- <p class="text-blue-600 font-bold mb-2">Grab your favorites and enjoy them anywhere.</p> -->
                <a href="{{ url('/order') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">Choose Take Out</a>
            </div>
            
        </div>
     </div>
</body>
</html>