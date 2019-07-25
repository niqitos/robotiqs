<nav class="navbar navbar-expand-sm shadow-md sticky-top">
    <a class="navbar-brand" href="{{ route('index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" height="31.75" viewBox="0 0 291.2 146.4">
            <path d="M-150.8-140v35.6h24V0h47.2V-140ZM1,3.2C38,3.2,64.4-23.6,64.4-70S38-143.2,1-143.2-62.4-116.4-62.4-70-36,3.2,1,3.2ZM1-34.6C-8.2-34.6-15-43-15-70s6.8-35.4,16-35.4S17-97,17-70,10.2-34.6,1-34.6ZM69.2-140v35.6h24V0h47.2V-140Z" transform="translate(150.8 143.2)"/>
        </svg>                      
    </a>

    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item dropdown ml-2 ml-sm-3">
            <a class="nav-link dropdown-toggle px-0" href="#" id="topic" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Topic') }}
            </a>

            <div class="dropdown-menu shadow-sm border-0 overflow-auto" aria-labelledby="topic">
                @foreach ($topics as $topic)
                    <a class="dropdown-item small" href="{{ route('topic.show', $topic->slug) }}">
                        {{ $topic->name }}
                    </a>
                @endforeach
            </div>
        </li>

        <li class="nav-item dropdown d-none d-sm-block ml-3 {{ $popularTabName ? 'active' : null }}">
            <a class="nav-link dropdown-toggle px-0" href="#" id="popular" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ $popularTabName ?: __('Popular') }}
            </a>

            <div class="dropdown-menu shadow-sm border-0" aria-labelledby="popular">
                <a class="dropdown-item small" href="{{ route('articles.today')}}">{{ __('Today') }}</a>
                <a class="dropdown-item small" href="{{ route('articles.week')}}">{{ __('This Week') }}</a>
                <a class="dropdown-item small" href="{{ route('articles.month')}}">{{ __('This Month') }}</a>
                <a class="dropdown-item small" href="{{ route('articles.year')}}">{{ __('This Year') }}</a>
                <a class="dropdown-item small" href="{{ route('articles.alltime')}}">{{ __('All Time') }}</a>
            </div>
        </li>

        <li class="nav-item d-none d-sm-block ml-3 {{ url()->current() == route('articles.latest') ? 'active' : null }}">
            <a class="nav-link px-0" href="{{ route('articles.latest')}}">{{ __('Latest') }}</a>
        </li>
    </ul>

    <ul class="nav navbar-nav ml-auto flex-row">
        <li class="nav-item d-flex align-items-center">
            <a class="nav-link write" href="{{ route('article.create') }}">{{ __('Write') }}</a>
        </li>

        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                @guest     
                    <i class="far fa-user-circle mr-1" style="font-size:20px"></i>
                @else
                    @if(auth()->user()->picture)
                        <img class="mr-1" src="{{ auth()->user()->picture }}" alt="{{ auth()->user()->name }}" height="20px">
                    @else
                        <span class="mr-1">{{ auth()->user()->initials() }}</span>
                    @endif
                @endguest
            </a>

            <div class="dropdown-menu shadow-sm mr-auto border-0" style="right:0;left: unset;" aria-labelledby="navbarDropdown">
                <theme-switch current-theme="{{ $theme }}" endpoint="{{ route('theme.update') }}" label="{{ __('Night') }}"></theme-switch>

                @guest
                    <a class="dropdown-item small" href="{{ route('login') }}">{{ __('Log In') }}</a>
                @else
                    <a class="dropdown-item small" href="{{ route('profile.articles', auth()->user()) }}">{{ __('Profile') }}</a>
                    
                    <logout endpoint="{{ route('logout') }}" label="{{ __('Logout') }}"></logout>
                @endguest
            </div>
        </li>
    </ul>
</nav>
