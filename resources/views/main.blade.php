<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Middle of the Pack</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="/css/app.css">

    </head>
    <body>
        <div id="app" class="full-height">
            <app
                json = "{{ json_encode($data->json)}}"
                view = "{{$data->view}}"
            ></app>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
