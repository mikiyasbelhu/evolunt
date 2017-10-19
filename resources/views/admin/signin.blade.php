@extends('templates.default')

@section('center_post')

    <div class="row">
        <h3>Sign in as Admin</h3>

        <div class="col-lg-8">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.signin') }}" >
                <div class="form-group{{ $errors->has('email')? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" name="email" id="email" value="{{ Request::old('email') ?: ''}}"
                           class="form-control" autofocus>
                    @if( $errors->has('email') )
                        <span class="help-block">{{ $errors->first('email') }}</span>
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
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-azure">Sign in</button>
                </div>
                <input type="hidden" name="_token" value="{{ \Illuminate\Support\Facades\Session::token() }}">
                </form>
        </div>
    </div>
@endsection