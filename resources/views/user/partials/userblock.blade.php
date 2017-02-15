<li>
    <div class="media">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('profile.index', ['username'=>$user->username]) }}" class="pull-left">
                    <img src="../../../../evolunt/public/images/{{ $user->picture }}"
                         class="img-circle" style="margin-right: 10px" width="50" height="50"
                         href="{{ route('profile.index', ['username'=>$user->username]) }}"
                         alt="{{ $user->getNameOrUsername() }}" class="media-object">
                </a>
                <h5 class="media-heading">
                    <a href="{{ route('profile.index', ['username'=>$user->username]) }}">{{ $user->getNameOrUsername() }}</a>
                    <br>
                     @<span class="small">{{  $user->username }}</span>
                    @if ($user->location)
                        <p class="small">{{ $user->location }}
                        </p>
                    @endif
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="media-body">
                    <h5 class="media-heading">
                        <div class="m-t-md btn-group" style="display: inline">
                            <form action="{{ route('message.view',['friend_id' => $user->id ]) }}"
                            >
                                <button class="btn btn-sm  btn-azure pull-left"
                                        style='display: inline'></span>Message
                                </button>
                            </form>

                            @if (!Auth::user()->isFollowing($user))
                                <a href="{{ route('friends.follow', ['username' => $user->username ]) }}"
                                   class="btn btn-sm  btn-palegreen pull-left"
                                   style='display: inline'>Follow
                                </a>
                            @else

                                <form action="{{ route('friends.unfollow', ['username' => $user->username]) }}"
                                      method="post">
                                    <input type="hidden" name="_token"
                                           value="{{ csrf_token() }}" style='display: inline'>
                                    <button type="submit"
                                            class="btn btn-sm btn-palegreen pull-left"
                                            style='display: inline'>
                                        Unfollow
                                    </button>
                                </form>
                            @endif
                        </div>
                    </h5>

                </div>
            </div>
        </div>
    </div>

</li>
