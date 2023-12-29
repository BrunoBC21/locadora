<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <header class="header">

        </header>

            <nav>
                <ul>
                    <li>
                        <a id="home" href="/">Home</a>
                    </li>

                    <li>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a id="cadastrar-veiculo" href="/cadastrar-veiculo">Inserir veículos</a>
                            @endif
                        @endauth
                    </li>

                    <li>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a id="agendamentos" href="/meus-agendamentos">Agendados</a>
                            @endif
                        @endauth
                        @auth
                            @if(auth()->user()->role === 'user')
                                <a id="agendamentos" href="/meus-agendamentos">Meus  Agendamentos</a>
                            @endif
                        @endauth
                    </li>

                    <li>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a id="cancelados" href="/cancelados">Cancelados</a>
                            @endif
                        @endauth
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" id="logout">
                            Logout</a>
                        </form> 
                    </li>

                </ul>
            </nav>

    </div>
    @yield('content')

</body>
</html>
