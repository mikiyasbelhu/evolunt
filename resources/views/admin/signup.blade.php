@extends('templates.default')

@section('center_post')

    <div class="row">
        <h3>Add Admin</h3>

        <div class="col-lg-8">
            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                  action="{{ route('admin.add') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email')? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" name="email" id="email" value="{{ Request::old('email') ?: ''}}"
                           class="form-control" autofocus>
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
                <div class="form-group">
                    <button type="submit" class="btn btn-azure">Add</button>
                </div>
                <input type="hidden" name="_token" value="{{ \Illuminate\Support\Facades\Session::token() }}">
            </form>
        </div>
    </div>
@endsection