<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>math app</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="bg-slate-100 min-h-screen flex justify-center items-center">
        <div class="flex flex-col items-center space-y-4">
            <div>Welcome to math app</div>
            <a href="/login">
                <x-primary-button>Login</x-primary-button>
            </a>
        </div>
    </div>
</body>

</html>
