<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/grid.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.css') }}">
        <title>Page 404</title>

    <script>
        (function(){
            window.Laravel = {
                csrfToken: '{{ csrf_token() }}'
            };
        })();
    </script>   


    </head>
    <body>
        <div class="container">
            <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
            <div
                class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
            >
            <H1 class="text-center fw-bold">You don't have enough to access this permission</H1>
            </div>
        </div>
    </body>

    <script src="{{ mix('js/app.js') }}"></script>
</html>
