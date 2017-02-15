@extends('templates.default')

@section('center_post')
    <div class="widget">
        <div class="widget-header">
            <h2 class="widget-caption">Create event </h2>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <form action="{{ route('event.add') }}" method="post">
                    <div class="content">
                        <div class="form-group{{ $errors->has('title')? ' has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" id="title" value="{{ Request::old('title') ?: ''}}"
                                   class="form-control">
                            @if( $errors->has('title') )
                                <span class="help-block">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('description')? ' has-error' : '' }}">
                            <label for="description" class="control-label">Description</label>
                        <textarea type="text" name="description" id="description"
                                  value="{{ Request::old('description') ?: ''}}"
                                  class="form-control"></textarea>
                            @if( $errors->has('description') )
                                <span class="help-block">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('date')? ' has-error' : '' }}">
                            <label for="date" class="control-label">Date</label>
                            <input type="date" name="date" id="date" value="{{ Request::old('date') ?: ''}}"
                                   class="form-control">
                            @if( $errors->has('date') )
                                <span class="help-block">{{ $errors->first('date') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('username')? ' has-error' : '' }}">
                            <label for="username" class="control-label"></label>
                            <button type="submit" name="submit" class="btn btn-azure pull-right">
                                Create
                            </button>
                        </div>

                    </div>
                    <input type="hidden" name="_token" value="{{  csrf_token() }}">
                </form>

            </div>
        </div>
    </div>
@endsection

@section('right_post')
    <div class="widget">
        <div class="widget-header">
            <h3 class="widget-caption">Coming up events </h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        @if (!$events->count())
                            <li>You have no coming up events</li>
                        @else
                            @foreach($events as $event)
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
