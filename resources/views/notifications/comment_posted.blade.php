<a href="{{route('admin.comments.show', $notification->data['post_id'])}}" class="list-group-item">
    <span class="badge">{{$notification->created_at->diffForHumans()}}</span>
    <i class="fa fa-fw fa-comment"></i> Commented on a post
</a>