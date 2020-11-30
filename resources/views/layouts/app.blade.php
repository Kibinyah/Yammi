<!doctype html>

<html lang="en">
    <head>

        <title>Yammi - @yield('title')</title>
    
    </head>

    <body>

        @section('sidebar')

        @show

        <div class="container">
            @yield('content')

        </div>

       
    </body>
</html>