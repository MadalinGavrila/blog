<a href="{{route('admin.comment.replies.show', $notification->data['comment_id'])}}" class="list-group-item">
    <span class="badge">{{$notification->created_at->diffForHumans()}}</span>
    <i class="fa fa-comments"></i> Replied on a comment
</a>