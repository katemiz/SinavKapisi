<nav class="navbar is-dark is-transparent">

    <div class="navbar-brand">

        <a href="/" class="navbar-item">
            <img src="{{asset('images/app_header_logo.svg')}}" alt="header logo">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar_ana">
            <span aria-hidden="true" />
            <span aria-hidden="true" />
            <span aria-hidden="true" />
        </a>

    </div>

    <div id="navbar_ana" class="navbar-menu">

      <div class="navbar-start has-text-white" id="navstart">

        <a href="/kapsam" class="navbar-item">Konular</a>

        @if(Auth::check())

            <div class="navbar-item has-dropdown is-hoverable">
                <p class="navbar-link">eSoru</p>
                <div class="navbar-dropdown">
                    <a href="/esoru-form" class="navbar-item">eSoru Ekle</a>
                    <a href="/soru-list" class="navbar-item">eSorular</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <p class="navbar-link">Kağıt Sınav</p>
                <div class="navbar-dropdown">
                    <a href="/kagit-sinavlar" class="navbar-item">Kağıt Sınavlar</a>
                    <a href="/kagit-sinav" class="navbar-item">Kağıt Sınav Ekle</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <p class="navbar-link">Harun</p>
                <div class="navbar-dropdown">
                    <a href="/harun" class="navbar-item">Chartisan</a>
                </div>
            </div>

        @endif

      </div>

      <div class="navbar-end  has-text-white">

        <div class="navbar-item">
          <div class="buttons">

              @if(Auth::check())

                <div class="navbar-item has-dropdown is-hoverable">
                    <p class="navbar-link">{{ Auth::user()->name }}</p>

                    <div class="navbar-dropdown">


                      <a  href="/projects" class="navbar-item">Settings</a>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a :href="route('logout')" class="navbar-item"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                        </a>
                        </form>

                    </div>
                  </div>
              @else

                <a href="{{route('login')}}" class="navbar-item has-text-white">
                    <span class="icon">
                        <x-icon icon="login" fill="{{config('constants.icons.color.light')}}"/>
                    </span>
                    <span class="ml-1">Giriş</span>
                </a>

                <a href="{{route('register')}}" class="navbar-item has-text-white">
                    <span class="icon">
                        <x-icon icon="user" fill="{{config('constants.icons.color.light')}}"/>
                    </span>
                    <span class="ml-1">Kaydolun</span>
                </a>

              @endif

          </div>
        </div>

      </div>

    </div>

  </nav>
