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
        <div class="max-w-6xl px-4 mx-auto">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <!-- Website Logo -->
                        <a href="#" class="flex items-center px-2 py-4">
                            <span class="text-lg font-semibold text-gray-500">e-learning</span>
                        </a>
                    </div>
                </div>
                <!-- Primary Navbar items -->
                <div class="items-center hidden space-x-3 md:flex ">



                    </span>
                    <!-- Logout Button --><a href="/profile" class="block px-4 py-2 font-semibold text-gray-700 hover:bg-indigo-600 hover:text-white">{{ Auth::user()->name }} Profile</a>

                    <form method="POST" action="{{ route('logout') }}" class="px-2 py-4">
                        @csrf
                        <button type="submit" class="px-4 py-2 font-semibold text-red-500 hover:bg-red-600 hover:text-white">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container px-4 py-8 mx-auto">

    </div>
