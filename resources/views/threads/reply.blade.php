<div class="card-header">
    <div class="level">
        <div class="flexAKM">
            <a href="{{ route('profile', $reply->owner) }}">
                {{$reply->owner->name}}
            </a>  said {{ $reply->created_at->diffForHumans() }}...
        </div>
        <div>
            <form method="post" action="/replies/{{ $reply->id }}/favorites">
                {{ csrf_field() }}
                <button type="submit" class="btn-primar" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                    {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                </button>
            </form>
        </div>
    </div>
</div>

<div class="card-body">
    {{ $reply->body }}
</div>
<hr>
