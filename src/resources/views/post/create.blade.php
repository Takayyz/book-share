
@extends('layouts.app')

@section('content')

<div class="container">
   <h1 class="review">レビュー</h1>
    <form action="{{ route('post.store') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="p_text" class="review">レビュー投稿</label>
            <textarea id="text" class="form-control" name="p_text" rows="8" required placeholder="読んだ本のレビューを投稿しよう"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">{{ __('新規投稿') }}</button>
    </form>

    <div>
        @foreach ($postData as $post)
        <p>名前</p> 
        <p>{{ $post->p_text }}</p>
        <form action="{{}}">
            <button>いいね</button>
        </form>
        @endforeach
    </div>
    
</div>
@endsection