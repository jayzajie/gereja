<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gereja Toraja Eben-Haezer Selili</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="font-poppins">
        <div class="min-h-screen bg-gray-100">


            <main>
                @yield('content')
            </main>


        </div>
    </body>
</html>
