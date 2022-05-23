@component('mail::message')
# You Received a Comment on Your Post

## You posted:

@if($comment->post->author->profile_picture_url)
<img src="{{ $comment->post->author->profile_picture_url }}" style="object-fit: cover; width:75px; height: 75px; border-radius: 50%" alt="Your Profile Picture">
@endif

> **{{ $comment->post->title }}** {{ $comment->post->content }}


@if($comment->author->profile_picture_url)
<img src="{{ $comment->author->profile_picture_url }}" style="object-fit: cover; width:75px; height: 75px; border-radius: 50%;" alt="Profile Picture Commentator">
@endif

## {{ $comment->author->name }} (<a href="mailto:{{$comment->author->email}}">{{ $comment->author->email }}</a>) replied:

> {{ $comment->content }}

@endcomponent
