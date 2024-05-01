<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ... -->
    @vite('resources/js/app.ts', 'build')
    @vite('resources/sass/app.scss', 'build')
</head>
<body>
    <div id="app">
        <h1>Teste</h1>
        <Message></Message>
    </div>

    @vite('resources/js/app.ts')
</body>
</html>