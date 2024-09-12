<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="shortcut icon" href="#" />

    @include('saas-platform.css.responsive_media_query')
    <style>
        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .package_header {
            background-color: #000000d6;
        }

        p {
            font-size: 15px;
            padding: 0px;
            margin: 0px;
        }

        .description {
            min-height: 300px;
        }

        h1.heading_h1 {
            color: #6f3a74;
            text-align: right;
        }

        .login_div {
            text-align: right;
        }

        .package_header.pt-4.text-white.text-center {
            padding: 5px;
        }

        .project_title {
            font-size: 32px;
            font-weight: 600;
            color: #025f3a;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="flex-center position-ref full-height text-center card mb-2" style="background: #ebebeb;">
            <div class="content p-4">
                <div class="project_title m-b-md">
                    {{ $general_setting->company_name ?? '' }}
                </div>
                {{-- <img src="{{ asset('public/logo') }}/{{ $general_setting->site_logo ?? '' }}" style="width:120px"> --}}
                <div class="links">
                    <p> {{ $general_setting->address ?? '' }}</p>
                </div>
            </div>
        </div>

        @if (Session::has('success'))
            <p class="alert {{ Session::get('alert-class', 'alert-primary') }}">{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('delete'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('delete') }}</p>
        @endif


        <div class="row ">
            <div class="col-12 col-md-8">
                <h1 class="heading_h1">Subcription Packages List</h1>
            </div>
            <div class="col-12 col-md-4 mt-3 ">
                <div class="login_div">
                    @if (Auth::user())
                        <a class="login_btn" href="{{ route('index') }}"
                            style="background-color: #026f43;padding: 9px 26px; color:#fff; font-weight:600; font-size:18px; text-decoration:none; ">
                            Go To Dashboard
                        </a>
                    @else
                        <a class="login_btn" href="{{ route('login') }}"
                            style="background-color: #026f43;padding: 9px 26px; color:#fff; font-weight:600; font-size:18px; text-decoration:none; ">
                            Login
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <div class="row pt-4">
            @if (!empty($subscription_packages))
                @foreach ($subscription_packages as $package)
                    <div class="col-md-4">
                        <div class="package_main card border mt-4" style="position: relative; z-index:999;">
                            <div class="package_header pt-4 text-white text-center">
                                <h2>{{ $package->name ?? '' }}</h2>
                                <p>{!! $package->short_description ?? '' !!}</p>
                            </div>
                            <div class="package_price text-center">
                                <br>
                                <h4>
                                    <strong class="">{{ $package->price ?? '' }} <strong>BDT</strong></strong>

                                </h4>
                                <p>
                                    <strong class="">
                                        For
                                        @if (!empty($package->package_duration))
                                            {{ $package->package_duration->value ?? '' }}
                                            @if ($package->package_duration->type == 1)
                                                Day
                                            @elseif($package->package_duration->type == 2)
                                                Week
                                            @elseif($package->package_duration->type == 3)
                                                Month
                                            @elseif($package->package_duration->type == 4)
                                                Year
                                            @else
                                                Not Found
                                            @endif
                                        @endif
                                    </strong>
                                </p>
                            </div>
                            <hr>
                            <div class="description">
                                <p class="text-center">
                                    {!! $package->description ?? '' !!}
                                </p>
                            </div>
                            <form action="{{ route('register') }}" method="GET">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $package->id ?? '' }}">
                                <div class="package_footer text-center pb-4">
                                    <button type="submit" target="_blank"
                                        style="background-color: rgb(111, 58, 116);padding: 10px 20px; color:#fff;text-decoration:none; font-weight:600; font-size:15px;border:none; ">
                                        Subscribe Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mt-5">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <p class="text-left">© 2023 - {{ date('Y') }} <a
                                href="{{ $general_setting->company_website_link ?? '' }}" target="_blank"
                                style="text-decoration:none;color:red"> {{ $general_setting->company_name ?? '' }}</a>
                            All rights
                            reserved.</p>
                    </li>
                    <li class="nav-item">
                        <img style="position: absolute; bottom: 0px;  right: 0px; max-width:20%; z-index: 0;height:35px !important"
                            src="{{ asset('setting/company_logo/' . $general_setting->company_logo) }}">
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
