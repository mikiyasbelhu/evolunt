@extends('templates.default')

@section('center_post')
    @if (!$items->count())
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        <li>There are no donations in the stock. Please contribute.</li>
                    </ul>
                </div>
            </div>
        </div>

    @else
        @foreach($items as $item)

            <div class="col-md-6">
                <div class="contact-box center-version">
                    <a href="{{ route('item.view', ['item' => $item->id]) }}">
                        <img alt="image" class="img-circle"
                             src="../../../../evolunt/public/images/{{ $item->picture }}">

                        <h3 class="m-b-xs"><strong>{{ $item->name }}</strong></h3>

                        <div class="font-bold">{{ $item->description }}</div>
                    </a>

                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            @if($item->user_id == Auth::user()->id)
                                <a href=""
                                   class="btn btn-xs btn-white"></i>Your Donation</a>
                            @elseif(Auth::user()->hasAsked($item))
                                <a href="{{ route('item.ask', ['item' => $item->id]) }}" class="btn btn-xs btn-azure">You've Asked
                                    for it
                                </a>
                                <a href="{{ route('profile.index', ['username' => $item->user->username]) }}"
                                   class="btn btn-xs btn-white"></i>Contact Creator</a>
                            @else
                                <a href="{{ route('item.ask', ['item' => $item->id]) }}" class="btn btn-xs btn-azure">Ask
                                    for it
                                </a>
                                <a href="{{ route('profile.index', ['username' => $item->user->username]) }}"
                                   class="btn btn-xs btn-white"></i>Contact Creator</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    @endif

@endsection

@section('right_post')
    <div class="widget">
        <a href="{{ route('item.add') }}"
           class="btn btn-azure">Donate</a>
    </div>
    <div class="widget">
        <div class="widget-header">
            <h3 class="widget-caption">Your donations</h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        @if (!$yourItems->count())
                            <li>You have never donated anything.</li>
                        @else
                            @foreach($yourItems as $item)
                                <li>
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="media-heading"><a href="">{{ $item->name }}</a></h5>

                                            <p><a href="#">
                                                    <img src="../../../../evolunt/public/images/{{ $item->picture }}"
                                                         width="60"
                                                         height="60" href="#" alt="{{ $item->name }}"
                                                         class="media-object">
                                                </a>
                                            </p>

                                            <p>{{ $item->description }}</p>

                                            <p>Quantity: {{ $item->quantity }}</p>

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