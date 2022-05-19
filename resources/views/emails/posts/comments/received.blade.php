@component('mail::message')
# You Received a Comment on Your Post

## You posted:

<img src="{{$comment->post->author->profile_picture_url}}" style="width:75px; height: 75px; border-radius: 50%" alt="Your Profile Picture">

> **{{ $comment->post->title }}** {{ $comment->post->content }}



<img src="{{$comment->author->profile_picture_url}}" style="width:75px; height: 75px; border-radius: 50%" alt="Profile Picture Commentator">

## {{ $comment->author->name }} ({{ $comment->author->email }}) replied:

> {{ $comment->content }}

@endcomponent
