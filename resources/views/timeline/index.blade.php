@extends('templates.default')

@section('center_post')

        <!-- post state form -->
<div class="box profile-info n-border-top">
    <form action="{{ route('status.post') }}" method="post">
        <textarea class="form-control input-lg p-text-area" name="status" rows="3"
                  placeholder="Whats in your mind today?"></textarea>

        <div class="box-footer box-form{{ $errors->has('status')? ' has-error' : '' }}">
            <input type="submit" class="btn btn-azure pull-right" value="Post">
            @if( $errors->has('status') )
                <span class="help-block">{{ $errors->first('status') }}</span>
            @endif
            <ul class="nav nav-pills">
            </ul>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
</div><!-- end post state form -->
<!--   posts -->
@if (!$statuses->count())
    <div class="box box-widget">
        <div class="box-header with-border">
            <div class="user-block">
                <p>There's nothing in your timeline</p>
            </div>
        </div>
    </div>
@else
    @foreach($statuses as $status)
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <img class="img-circle" src="../../../../evolunt/public/images/{{ $status->user->picture }}"
                         alt="{{ $status->user->getNameOrUsername() }}">
                    <span class="username"><a
                                href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></span>
                    <span class="description">{{ $status->created_at->diffForHumans() }}</span>
                </div>
            </div>

            <div class="box-body" style="display: block;">
                <p style="font-size: 18px;">{{ $status->body }}</p>
                @if (! Auth::user()->hasLikedStatus($status))
                    <a href="{{ route('status.like',['statusId' => $status->id]) }}" type="button"
                       class="btn btn-default btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span> Like
                    </a>
                @else
                    <a href="{{ route('status.unlike',['statusId' => $status->id]) }}" type="button"
                       class="btn btn-default btn-xs"><span class="glyphicon glyphicon-thumbs-down"></span> Unlike
                    </a>
                @endif
                <span class="pull-right text-muted">{{ $status->likes->count() }} {{ str_plural('like',$status->likes->count()) }}</span>
            </div>

            <div class="box-footer box-comments" style="display: block;">
                @foreach($status->replies as $reply)
                    <div class="box-comment">
                        <img class="img-circle img-sm"
                             src="../../../../evolunt/public/images/{{ $reply->user->picture }}"
                             alt="{{ $reply->user->getNameOrUsername() }}">

                        <div class="comment-text">
                          <span class="username">
                          <a
                                  href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a>
                          <span class="text-muted pull-right">{{ $reply->created_at->diffForHumans() }}</span>
                          </span>

                            <p>{{ $reply->body }}</p>
                            @if (! Auth::user()->hasLikedStatus($reply))
                                <a href="{{ route('status.like',['statusId' => $reply->id]) }}" type="button"
                                   class="btn btn-default btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span> Like
                                </a>
                            @else
                                <a href="{{ route('status.unlike',['statusId' => $reply->id]) }}" type="button"
                                   class="btn btn-default btn-xs"><span class="glyphicon glyphicon-thumbs-down"></span> Unlike
                                </a>
                            @endif
                            <span class="pull-right text-muted">{{ $reply->likes->count() }} {{ str_plural('like',$reply->likes->count()) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="box-footer" style="display: block;">
                <form action="{{ route('status.reply',['statusId' => $status->id ])}}" method="post">
                    <img class="img-responsive img-circle img-sm"
                         src="../../../../evolunt/public/images/{{ Auth::user()->picture }}" alt="Alt Text">

                    <div class="img-push{{ $errors->has("reply-{$status->id}")? ' has-error' : '' }}">
                        <input type="text" class="form-control input-sm"
                               placeholder="Press enter to post comment" name="reply-{{ $status->id }}">
                        @if ($errors->has("reply-{$status->id}"))
                            <span class="help-block">
                                    {{ $errors->first("reply-{$status->id}") }}
                                </span>
                        @endif
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
            <hr>
        </div>
        @endforeach
                <!--  end posts-->
        {!! $statuses->render() !!}

        @endif
        @endsection

@section('right_post')
    @if (Auth::user()->admin==1)
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

    @if (!Auth::user()->admin==1)
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
    @endif

@endsection

