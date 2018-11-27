              <header id="header" id="home">
                <div class="container">
                    <div class="row align-items-center justify-content-between d-flex">
                      <div id="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('storage/logo.png') }}" alt="" title="" /></a>
                      </div>
                      <nav id="nav-menu-container">
                        <ul class="nav-menu">

                             @guest
                                <li><a href="/userdashboard">Find Work</a></li>
                                <li><a href="/how-it-work">How it Works</a></li>
                             @else
                             @if(Auth::user()->role == 1)
                                <li><a href="/userdashboard">Find Work</a></li>
                                <li><a href="/profile/{{str_slug(strtolower(Auth::user()->name), '-')}}">Profile</a></li>
                                <li><a href="/my-jobs">My Jobs</a></li>
                                <li><a href="#">Message</a></li>
                             @endif  

                             @if(Auth::user()->role == 2)
                                <li><a href="/userdashboard">Find Work</a></li>
                                <li><a href="/profile/{{str_slug(strtolower(Auth::user()->name), '-')}}">Profile</a></li>
                                <li><a href="/my-jobs">My Jobs</a></li>
                                <li><a href="#">Message</a></li>
                            @endif     
                            @if(Auth::user()->role == 3)
                                <li><a href="/panel/freelancer">Jobseeker</a></li>
                                <li><a href="/panel/clients">Cleints</a></li>
                                <li><a href="/panel/jobs">Jobs</a></li>

                            @endif  
                            @endguest

                           @guest
                          <li><a class="ticker-btn" href="{{ route('login') }}">Login</a></li>
                          <li><a class="ticker-btn" href="{{ route('register') }}">Signup</a></li>
                           @else
                          <li class="menu-has-children"><a href="">{{ Auth::user()->name }}</a>
                            <ul>
                                 @if(Auth::user()->role == 1)
                                <li><a href="/dashboard">Account Settings</a></li>
                                  @endif  
                                <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Logout</a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </li>
                            </ul>
                          </li>
                    
                            @endguest                                                 
                        </ul>
                      </nav><!-- #nav-menu-container -->                    
                    </div>
                </div>
              </header><!-- #header -->