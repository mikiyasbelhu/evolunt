@extends('templates.default')

@section('center_post')
    <div class="col-md-12">
        <div class="contact-box center-version">
            <a href="#">
                <img alt="image"
                     src="/images/{{ $item->picture }}">
                <h3 class="m-b-xs"><strong>{{ $item->name }}</strong></h3>
                <div class="font-bold">{{ $item->description }}</div>
            </a>

            <div class="contact-box-footer">
                <div class="m-t-xs btn-group">
                    <a href="{{ route('profile.index', ['username' => $item->user->username]) }}"
                       class="btn btn-xs btn-white"></i>Contact Creator</a>
                </div>
            </div>
        </div>
    </div>
@endsection
