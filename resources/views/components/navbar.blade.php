<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('tasks.index') }}" style="margin-left:20px;">TODO manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mr-0" style=" margin-left: auto; margin-right: 0px;">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Zadania
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                        <a class="dropdown-item" href="{{ route('tasks.index', ['type' => Task::getStatus('Active')]) }}">
                            Aktywne
                        </a>

                        <a class="dropdown-item" href="{{ route('tasks.index', ['type' => Task::getStatus('Completed')]) }}">
                            Zakończone
                        </a>


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('tasks.add')}}">Dodaj nowe zadanie</a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tagi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('tags.index')}}">Wszystkie tagi</a>
                        <a class="dropdown-item" href="{{ route('tags.add')}}">Dodaj nowy tag</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Zalogowany jako <b>{{ auth()->user()->name}}</b>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            <form action="{{ route('logout')}}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="btn btn-sm" type="submit" style="margin-left: 3px">
                                    Wyloguj się
                                </button>
                            </form>
                        </a>
                    </div>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dołacz do serwisu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('login') }}">
                            Zaloguj się
                        </a>
                        <a class="dropdown-item" href="{{ route('register') }}">
                            Zarejestruj się
                        </a>
                    </div>
                </li>

                @endauth

            </ul>

        </div>
    </div>
</nav>