@include('layouts.components.header')

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('img/logo.png') }}" alt="logo" width="150">
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>@yield('titleContent')</h4>
                            </div>
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            @if (Request::route()->getName() == 'login')
                            {{ __('pages.noAccount') }}
                            <a href="{{ route('register') }}">{{ __('pages.createAccount') }}</a>
                            @else
                            {{ __('pages.noAccount') }}
                            <a href="{{ route('login') }}">{{ __('pages.createAccount') }}</a>
                            @endif
                        </div>
                        <div class="simple-footer">
                            @include('layouts.backend.components.credit')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.components.footer')
    @yield('script')
</body>

</html>