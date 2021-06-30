<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        

        <title>GithubTag</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
        <br>
        <div id="app" class="container">
            <router-view></router-view>
            <!-- <example-component></example-component> -->
        </div>
    </body>

    <script src="{{ mix('/js/app.js') }}"></script>
</html>
