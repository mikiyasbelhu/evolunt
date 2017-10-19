@extends('templates.default')

@section('center_post')

    @if(!($friend == null))
        <div class="box-header with-border">
            @include('user.partials.userblock')
        </div>
    @endif
    <div class="col-md-12 box box-widget">
        <div class="chat-message" style="max-height: 600px;overflow-y:auto ">
            @if (!$conversation->count())
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="user-block">
                            <p>You have no recent messages</p>
                        </div>
                    </div>
                </div>
            @else

                <ul class="chat">
                    @foreach($messages as $message)
                        @if(!($message->user_id == Auth::user()->id))
                            <li class="left clearfix">
                  <span class="chat-img pull-left">
                    <img src="/images/{{ Auth::user()->getUser($message->user_id)->first()->picture }}"
                         alt="User Avatar">
                  </span>

                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">{{ Auth::user()->getUser($message->user_id)->first()->getNameOrUsername() }}</strong>
                                        <small class="pull-right text-muted">{{ $message->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p>
                                        {{ $message->content }}
                                    </p>
                                </div>
                            </li>
                        @else
                            <li class="right clearfix">
                  <span class="chat-img pull-right">
                    <img src="/images/{{ Auth::user()->picture }}" alt="User Avatar">
                  </span>

                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">You</strong>
                                        <small class="pull-right text-muted">{{ $message->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p>
                                        {{ $message->content }}
                                    </p>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
        @if(!($friend == null))
            <form action="{{ route('message.send',['friend_id' => $friend ])}}" method="post">
                <div class="chat-box_ bg-white">
                    <div class="input-group">
                        <input name="content" class="form-control border no-shadow no-rounded"
                               placeholder="Type your message here">
              <span class="input-group-btn">
                  <input type="submit" class="btn btn-azure pull-right" value="Send">

                  @if( $errors->has('content') )
                      <span class="help-block">{{ $errors->first('content') }}</span>
                  @endif
              </span>
                    </div><!-- /input-group -->
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        @endif
    </div>

@endsection


@section('right_post')
    <div class="row box box-widget">
        <div class="col-md-12 bg-white">
            <br>

            <div class="friend-name">
                <strong>Recent Messages</strong>
            </div>
            <div class="row border-bottom padding-sm">
                @if (!$messages->count())
                    <div class="box-header ">
                        <div class="user-block">
                            <p>You have no recent messages</p>
                        </div>
                    </div>
                    @else
                            <!-- message list -->
                    <ul class="friend-list">
                        <?php $conv = array(0);;
                        ?>
                        @foreach($conversation as $message)
                            @if ((!in_array($message->friend_id,$conv) and $message->user_id == Auth::user()->id) or
                            (!in_array($message->user_id,$conv) and $message->friend_id == Auth::user()->id))
                                <?php
                                if (!in_array($message->friend_id, $conv) and $message->user_id == Auth::user()->id)
                                    array_push($conv, $message->friend_id);
                                else
                                    array_push($conv, $message->user_id);
                                ?>
                                <li>
                                    @if($message->user_id == Auth::user()->id)
                                        <a href="{{ route('message.view',[' friend_id' => $message->friend_id ]) }}"
                                           class="clearfix">
                                            <img src="/images/{{ Auth::user()->getUser($message->friend_id)->first()->picture }}"
                                                 alt="" class="img-circle">

                                        <div class="friend-name">
                                            <strong>{{ Auth::user()->getUser($message->friend_id)->first()->getNameOrUsername() }}</strong>
                                        </div>
                                        <div class="last-message text-muted">{{ $message->content }}</div>
                                        <small class="time text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                        </a>
                                    @else
                                        <a href="{{ route('message.view',['friend_id' => $message->user_id ]) }}"
                                           class="clearfix">
                                            <img src="/images/{{ Auth::user()->getUser($message->user_id)->first()->picture }}"
                                                 alt="" class="img-circle">

                                            <div class="friend-name">
                                                <strong>{{ Auth::user()->getUser($message->user_id)->first()->getNameOrUsername() }}</strong>
                                            </div>
                                            <div class="last-message text-muted">{{ $message->content }}</div>
                                            <small class="time text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                        </a>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>

                @endif
            </div>
        </div>
    </div>
@endsection
