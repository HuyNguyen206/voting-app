@component('mail::message')
# A comment was posted on your idea

{{ $comment->user->name }} commented on your idea:

**{{ $comment->idea->title }}**
Comment: {{$comment->body}}

@component('mail::button', ['url' => route('ideas.show', $comment->idea->slug)])
Go to the idea
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
