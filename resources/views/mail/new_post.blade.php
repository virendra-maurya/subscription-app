<x-mail::message>
# Hello, {{ $user->name }}

Here is new post found in <b style="color: lightseagreen;">{{ $post->website->sub_domain }}</b> site

### Post Title: {{ $post->title }}

<x-mail::button :url="$post->post_url">
 See this post
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
