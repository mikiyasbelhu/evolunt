@extends('templates.default')

@section('center_post')
    <div class="widget">
        <div class="widget-header">
            <h2 class="widget-caption">Up coming events </h2>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
    </div>
@endsection

@section('right_post')
    <div class="widget">
        <a href="{{ route('event.add') }}"
           class="btn btn-azure">Create Event</a>
    </div>
    <div class="widget">
        <div class="widget-header">
            <h3 class="widget-caption">Your events </h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        @if (!$yourevents->count())
                            <li>You have no coming up events</li>
                        @else
                            @foreach($yourevents as $event)
                                <li>
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="media-heading"><a href="">{{ $event->title }}</a></h5>

                                            <p>{{ $event->description }}</p>
                                            <p>On: {{ $event->date }}</p>
                                            <p>By: <a href="{{ route('profile.index', ['username' => $event->user->username]) }}">{{ $event->user->getNameOrUsername() }}</a></p>

                                        </div>
                                    </div>

                                </li>
                            @endforeach
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>

@endsection
