@extends('templates.default')

@section('center_post')
    <div class="col-md-12">
        <div class="contact-box center-version">
            <a href="#">

                <h3 class="m-b-xs"><strong>{{ $fund->cause }}</strong></h3>

                <div class="font-bold">{{ $fund->description }}</div>

                <div class="font-bold">Amount to be raised :{{ $fund->amount }} Birr</div>

            </a>

            <div class="contact-box-footer">
                <div class="m-t-xs btn-group">
                    <a href="" class="btn btn-xs btn-azure">Support</a>
                    <a href="{{ route('profile.index', ['username' => $fund->user->username]) }}"
                       class="btn btn-xs btn-white"></i>Contact Creator</a>
                </div>
            </div>
        </div>
    </div>
@endsection