@extends('templates.default')

@section('center_post')
    <div class="widget">
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        @if (!($notifications->count()))
                            <li>You have no notifications</li>
                        @else
                            @foreach($notifications as $notification)
                                    @include('notification/notificationblock')
                            @endforeach
                    </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
