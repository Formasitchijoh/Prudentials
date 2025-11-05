<!Doctype html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="/app.css"></link> --}}
    <title>Pixel Position</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://font.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="h-full">
    <div class="h-full flex items-start ">
        <div class="w-[10rem] bg-teal-900 h-full">
            <img class="repeated-non w-lg h-2xl" src="/logo.jpeg" />
            <hr class="h-[2px] bg-white" />
            <nav class=" flex flex-col justify-center space-y-4 itemscenter text-white font-semibold pt-4">
                {{-- TODO make menu item a component --}}
                <a href="#" class="px-2">
                    <div class="flex space-x-4">
                        <span>Icon</span>
                        <span>Dashboard</span>
                    </div>
                </a>

                <a href="#" class="px-2">
                    <div class="flex space-x-4">
                        <span>Icon</span>
                        <span>Projects</span>
                    </div>

                </a>
            </nav>

        </div>
        <main class="">
            {{ $slot }}
        </main>
    </div>

    </div>
</body>
</html>
