@extends('templates.default')

@section('center_post')
    <div class="widget">
        <div class="widget-header">
            <h2 class="widget-caption">Create Fundraiser</h2>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <form action="{{ route('fund.add') }}" method="post">
                    <div class="content">
                        <div class="form-group{{ $errors->has('cause')? ' has-error' : '' }}">
                            <label for="cause" class="control-label">Cause</label>
                            <input type="text" name="cause" id="cause" value="{{ Request::old('cause') ?: ''}}"
                                   class="form-control">
                            @if( $errors->has('cause') )
                                <span class="help-block">{{ $errors->first('cause') }}</span>
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
                        <div class="form-group{{ $errors->has('amount')? ' has-error' : '' }}">
                            <label for="amount" class="control-label">Amount (BIRR)</label>
                            <input type="number" name="amount" id="amount" value="{{ Request::old('amount') ?: ''}}"
                                   class="form-control">
                            @if( $errors->has('amount') )
                                <span class="help-block">{{ $errors->first('amount') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('username')? ' has-error' : '' }}">
                            <label for="username" class="control-label"></label>
                            <button type="submit" name="submit" class="btn btn-azure pull-right">
                                Create Fundraiser
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
            <h3 class="widget-caption">Fundraisers </h3>
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
                                            <p>By: <a href="{{ route('profile.index', ['username' => $fund->user->username]) }}">{{ $fund->user->getNameOrUsername() }}</a></p>
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
