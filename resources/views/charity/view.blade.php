@extends('templates.default')

@section('center_post')
    <div class="widget">
        <?php  $current = Auth::user() ?>
            <p>

            <form action=" {{ route('search.results') }}">
                <input type="text" name="query" placeholder="Search" class="form-control">
            </form>
            </p>

        <div class="widget-header">
            <h3 class="widget-caption">Your Charities </h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        @if (!$current->iFollow()->count())
                            <li>You are following no Charities</li>
                        @else
                            @foreach($current->iFollow() as $user)
                                @if ($user->charity==1)
                                    @include('user.partials.userblock')
                                @endif
                            @endforeach
                    </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
