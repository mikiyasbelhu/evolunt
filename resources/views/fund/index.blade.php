@extends('templates.default')

@section('center_post')
    @if (!$funds->count())
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        <li>There are no funds to be raised</li>
                    </ul>
                </div>
            </div>
        </div>

    @else
        @foreach($funds as $fund)

            <div class="col-md-6">
                <div class="contact-box center-version">
                    <a href="{{ route('fund.view', ['fund' => $fund->id]) }}">

                        <h3 class="m-b-xs"><strong>{{ $fund->cause }}</strong></h3>

                        <div class="font-bold">{{ $fund->description }}</div>

                        <div class="font-bold">Amount to be raised :{{ $fund->amount }} Birr</div>

                    </a>

                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            @if($fund->user_id == Auth::user()->id)
                                <a href=""
                                   class="btn btn-xs btn-white"></i>Your Fund</a>
                            @elseif(Auth::user()->hasSupported($fund))
                                <a href="{{ route('item.ask', ['item' => $fund->id]) }}" class="btn btn-xs btn-azure">Supporting
                                </a>
                                <a href="{{ route('profile.index', ['username' => $fund->user->username]) }}"
                                   class="btn btn-xs btn-white"></i>Contact Creator</a>
                            @else
                                <a href="{{ route('fund.support', ['fund' => $fund->id]) }}"
                                   class="btn btn-xs btn-azure">Support</a>
                                <a href="{{ route('profile.index', ['username' => $fund->user->username]) }}"
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
        <a href="{{ route('fund.add') }}"
           class="btn btn-azure">Create Fundraiser</a>
    </div>
    <div class="widget-body bordered-top bordered-sky">
        <div class="card">
            <div class="content">
                <ul class="list-unstyled team-members">
                    @if (!$funds->count())
                        <li>There are no Fundraisers</li>
                    @else
                        @foreach($funds as $fund)
                            <li>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="">{{ $fund->cause }}</a></h5>

                                        <p>Detail: {{ $fund->description }}</p>

                                        <p>Amount(BIRR) :{{ $fund->amount }}</p>

                                        <p>By:
                                            <a href="{{ route('profile.index', ['username' =>  Auth::user()->getUser($fund->user_id)->first()->username]) }}">{{ Auth::user()->getUser($fund->user_id)->first()->getNameOrUsername() }}</a>
                                        </p>
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