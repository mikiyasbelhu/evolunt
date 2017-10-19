@extends('templates.default')

@section('center_post')

    <div class="widget">
        <p><form action=" {{ route('search.results') }}">
            <input type="text" name="query" placeholder="Search" class="form-control" value="{{ $query ?: ''}}">
        </form></p>
        <div class="widget-header">
            <h3 class="widget-caption">Search results for <b>{{ Request::input('query') }}</b> </h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        @if (!$users->count())
                            <li>Sorry, No results found</li>
                        @else
                            @foreach($users as $user)
                                @include('user.partials.userblock')
                            @endforeach
                    </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection