<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                            @if (Auth::user()->isAdmin())
                                <li>
                                    <a href="{{ route('users.index') }}" class="dropdown-toggle" role="button"
                                       aria-expanded="false">
                                        Manage Users
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('prices.index') }}" class="dropdown-toggle" role="button"
                                       aria-expanded="false">
                                        Manage Prices
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('devices.index') }}" class="dropdown-toggle" role="button"
                                       aria-expanded="false">
                                        Manage Devices
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('records.index') }}" class="dropdown-toggle" role="button"
                                       aria-expanded="false">
                                        Records
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- Scripts -->
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var priceInput = $('#ajaxPriceCalculate');

    function calculate() {
        $.ajax({
            type: 'POST',
            url: '/ajaxPrice',
            data: {
                device_id: $('input[name=device_id]:checked').val(),
                duration: priceInput.val(),
                _token: CSRF_TOKEN
            }
        }).done(function (price) {
            $('#calculated').html('Calculated: $' + price);
        });
    }

    priceInput.on('change keyup', calculate);
    $('input[name=device_id]').change(calculate);

    function showEdits(id) {
        $('.records[data-event-id=' + id + ']').toggle();
    }


</script>
<script src="/js/app.js"></script>
</body>
</html>
