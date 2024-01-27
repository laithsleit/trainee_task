<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... other head elements ... -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <!-- Website Logo -->
                        <a href="#" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-lg">e-learning</span>
                        </a>
                    </div>
                </div>
                <!-- Primary Navbar items -->
                <div class="hidden md:flex items-center space-x-3 ">

                    <span class="py-4 px-2 text-gray-500 font-semibold">Welcome, {{ Auth::user()->name }}

                    </span>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="py-4 px-2">
                        @csrf
                        <button type="submit" class="text-red-500 font-semibold">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mx-auto px-4 py-8">

    </div>
