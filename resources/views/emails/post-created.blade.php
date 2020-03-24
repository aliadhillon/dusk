@component('mail::message')
# New Post Created

Following post has been created.

{{ $post->title }}

@component('mail::button', ['url' => route('posts.show', ['post' => $post])])
See the post.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
