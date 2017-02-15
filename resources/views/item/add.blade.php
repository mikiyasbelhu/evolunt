@extends('templates.default')

@section('center_post')
    <div class="widget">
        <div class="widget-header">
            <h2 class="widget-caption">Donate an item</h2>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <form action="{{ route('item.add') }}" method="post" enctype="multipart/form-data">
                    <div class="content">
                        <div class="form-group{{ $errors->has('name')? ' has-error' : '' }}">
                            <label for="name" class="control-label">Item name</label>
                            <input type="text" name="name" id="name" value="{{ Request::old('name') ?: ''}}"
                                   class="form-control">
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
                        <div class="form-group{{ $errors->has('quantity')? ' has-error' : '' }}">
                            <label for="quantity" class="control-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity"
                                   value="{{ Request::old('quantity') ?: ''}}"
                                   class="form-control">
                            @if( $errors->has('quantity') )
                                <span class="help-block">{{ $errors->first('quantity') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image" class="control-label">Picture</label>
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
                                Donate
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
            <h3 class="widget-caption">Your Donations</h3>
        </div>
        <div class="widget-body bordered-top bordered-sky">
            <div class="card">
                <div class="content">
                    <ul class="list-unstyled team-members">
                        @if (!$items->count())
                            <li>There are no items donated</li>
                        @else
                            @foreach($items as $item)
                                <li>
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="media-heading"><a href="">{{ $item->name }}</a></h5>

                                            <p><a href="#" >
                                                    <img src="../../../../evolunt/public/images/{{ $item->picture }}"
                                                         width="60"
                                                         height="60" href="#" alt="{{ $item->name }}"
                                                         class="media-object">
                                                </a>
                                            </p>

                                            <p>{{ $item->description }}</p>

                                            <p>Quantity: {{ $item->quantity }}</p>

                                            <p>By:
                                                <a href="{{ route('profile.index', ['username' => $item->user->username]) }}">{{ $item->user->getNameOrUsername() }}</a>
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
