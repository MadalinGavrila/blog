<a href="{{route('home.post', $notification->data['slug'])}}" class="list-group-item">
    <span class="badge">{{$notification->created_at->diffForHumans()}}</span>
    <i class="fa fa-file"></i> A new post published
</a>