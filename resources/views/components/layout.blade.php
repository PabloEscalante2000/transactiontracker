@props(['title' => 'Manage your transactions!'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction Tracker | {{ $title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen">

    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Brand --}}
                <a href="/" class="flex items-center gap-2 text-indigo-600 font-semibold text-lg hover:text-indigo-700 transition-colors">
                    <i class="fa-solid fa-arrow-right-arrow-left text-xl"></i>
                    <span>TransactionTracker</span>
                </a>

                {{-- Auth buttons --}}
                <div class="flex items-center gap-3">
                @guest
                
                    <a href="/login"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors">
                        <i class="fa-solid fa-right-to-bracket text-base"></i>
                        Login
                    </a>
                    <a href="/register"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                        <i class="fa-solid fa-user-plus text-base"></i>
                        Registrarse
                    </a>
                @endguest
                @auth
                    <a href="/transactions"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors">
                        <i class="fa-solid fa-money-bill-wave text-base"></i>
                        Transactions
                    </a>
                    <a href="/categories"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors">
                        <i class="fa-solid fa-list text-base"></i>
                        Categories
                    </a>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                            <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                            Log out
                        </button>
                    </form>
                @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

</body>
</html>
