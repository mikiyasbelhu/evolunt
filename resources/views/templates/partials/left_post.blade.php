<!-- left links -->
@if (Auth::check())

    <div class="profile-nav">
        <div class="widget">
            <div class="widget-body">
                <div class="user-heading round">
                    <a href="{{ route('home') }}">
                        <img src="/images/{{ Auth::user()->picture }}" alt="">
                    </a>

                    <h1>{{ Auth::user()->getNameOrUsername() }}</h1>
                    <label><label>@</label>{{ Auth::user()->username }}</label>
                </div>

                <ul id="home"  class="nav nav-pills nav-stacked">
                    <li class="active"><a href="{{ route('home') }}"> News feed</a></li>
                    <li><a href="{{ route('message.index') }}">Messages</a></li>
                    <li><a href="{{ route('notifications.view') }}">Notification</a></li>
                    @if (Auth::user()->charity==0)
                        <li><a href="{{ route('friends.view') }}">Friends</a></li>
                        <li><a href="{{ route('charity.view') }}">Charities</a></li>
                    @else
                        <li><a href="{{ route('friends.view') }}">Followers</a></li>
                    @endif
                    <li><a href="{{ route('event.index') }}">Events</a></li>
                    <li><a href="{{ route('fund.index') }}">Fundraiser</a></li>
                    <li><a href="{{ route('item.index') }}">Stock</a></li>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    @endif
            <!-- end left links -->
