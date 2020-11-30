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

        <div>
            @if ($errors->any())
                <div>
                    Errors:
                    <ul>
                        @foreach($errors->all() as $error)

                            <li>{{ $error}}</li>

                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('message'))
                    <p><b>{{ session('message') }}</b></p>
            @endif
        </div>
    </body>
</html>