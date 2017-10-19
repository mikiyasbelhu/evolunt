@extends('templates.default')

@section('center_post')
    <div class="widget">
        <div class="widget-header">
            <h2 class="widget-caption">Add Charity</h2>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <form action="{{ route('charity.add') }}" method="post" enctype="multipart/form-data">
                    <div class="content">
                        <div class="form-group{{ $errors->has('name')? ' has-error' : '' }}">
                            <label for="name" class="control-label">Name of the Charity Organization</label>
                            <input type="text" name="name" id="name" value="{{ Request::old('name') ?: ''}}"
                                   class="form-control" autofocus >
                            @if( $errors->has('name') )
                                <span class="help-block">{{ $errors->first('name') }}</span>
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
                        <div class="form-group{{ $errors->has('email')? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email</label>
                            <input type="text" name="email" id="email" value="{{ Request::old('email') ?: ''}}"
                                   class="form-control">
                            @if( $errors->has('email') )
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('username')? ' has-error' : '' }}">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" name="username" id="username" value="{{ Request::old('username') ?: ''}}"
                                   class="form-control">
                            @if( $errors->has('username') )
                                <span class="help-block">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password')? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" name="password" id="password" value="" class="form-control">
                            @if( $errors->has('password') )
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image" class="control-label">Profile Picture</label>
                            <input type="file" name="image" class="form-control"/>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('username')? ' has-error' : '' }}">
                            <label for="username" class="control-label"></label>
                            <button type="submit" name="submit" class="btn btn-azure pull-right">
                                Add
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
    @if (!Auth::user()->admin==1)
        <div class="widget">
            <a href="{{ route('charity.add') }}"
               class="btn btn-azure">Add Charity</a>
            <a href="{{ route('admin.add') }}"
               class="btn btn-azure">Add Admin</a>
        </div>
    @endif
    <div class="widget">
        <?php  $current = Auth::user() ?>
        <div class="widget-header">
            <h3 class="widget-caption">Your followers </h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        @if (!$current->whoFollowsMe()->count())
                            <li>You have no followers</li>
                        @else
                            @foreach($current->whoFollowsMe() as $user)
                                @include('user.partials.userblock')
                            @endforeach
                    </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="widget">
        <?php  $current = Auth::user() ?>
        <div class="widget-header">
            <h3 class="widget-caption">You follow </h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        @if (!$current->iFollow()->count())
                            <li>You are following no one</li>
                        @else
                            @foreach($current->iFollow() as $user)
                                @include('user.partials.userblock')
                            @endforeach
                    </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
