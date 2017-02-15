<!-- Fixed navbar -->
<nav class="navbar navbar-white navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><b>eVolunt</b></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}"> {{ Auth::user()->getNameOrUsername() }} </a></li>
                    <li><a href="{{ route('profile.edit') }}">Update Profile</a></li>
                    <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
                @else
                    <li><a href="{{ route('register') }}">Sign up</a></li>
                    <li><a href="{{ route('login') }}">Sign in</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>