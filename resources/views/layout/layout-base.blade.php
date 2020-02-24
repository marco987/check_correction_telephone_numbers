<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Telephone Numbers</title>
        <!-- FONT: LATO -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div id="container">
            <header>
                <h1>Check and correction South African Mobile Numbers</h1>
            </header>
            <main>
                @yield('content')
            </main>
            <footer>
                <h5>Check and correction South African Mobile Numbers &copy; marco987</h5>
            </footer>
        </div>
    </body>
</html>
