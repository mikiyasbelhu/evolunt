<li>
    <div class="media">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('profile.index', ['username'=>Auth::user()->getUser($notification->user_id)->first()->username]) }}"
                   class="pull-left">
                    <img src="../../../../evolunt/public/images/{{ Auth::user()->getUser($notification->user_id)->first()->picture }}"
                         class="img-circle" style="margin-right: 10px" width="50" height="50"
                         href="{{ route('profile.index', ['username'=>Auth::user()->getUser($notification->user_id)->first()->username]) }}"
                         alt="{{ Auth::user()->getUser($notification->user_id)->first()->getNameOrUsername() }}"
                         class="media-object">
                </a>
                <h5 class="media-heading">
                    @if($notification->notifiable_type == 'evolunt\Item')
                        <a href="{{ route('profile.index', ['username'=>Auth::user()->getUser($notification->user_id)->first()->username]) }}">
                            {{ Auth::user()->getUser($notification->user_id)->first()->getNameOrUsername() }}</a>
                        is looking for your <a
                                href="{{ route('item.view', ['item' => Auth::user()->getItem($notification->notifiable_id)->first()->id]) }}">
                            {{ Auth::user()->getItem($notification->notifiable_id)->first()->name }}
                        </a>
                    @elseif($notification->notifiable_type == 'evolunt\Fund')
                        <a href="{{ route('profile.index', ['username'=>Auth::user()->getUser($notification->user_id)->first()->username]) }}">
                            {{ Auth::user()->getUser($notification->user_id)->first()->getNameOrUsername() }}</a>
                        wants to support your cause <a
                                href="{{ route('fund.view', ['fund' => Auth::user()->getFund($notification->notifiable_id)->first()->id]) }}">
                            {{ Auth::user()->getFund($notification->notifiable_id)->first()->cause }}
                        </a>
                    @endif
                    <small class="pull-right text-muted">{{ $notification->created_at->diffForHumans() }}
                    </small>
                    <br>
                    @<span class="small">{{  Auth::user()->getUser($notification->user_id)->first()->username }}</span>
                    @if (Auth::user()->getUser($notification->user_id)->first()->location)
                        <p class="small">{{ Auth::user()->getUser($notification->user_id)->first()->location }}
                        </p>
                    @endif
                </h5>
            </div>
        </div>
    </div>

</li>
