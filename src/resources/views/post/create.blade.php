
@extends('layouts.app')

@section('content')

<div class="container">
   <h1 class="review">レビュー</h1>
    <form action="{{ route('post.store') }}" method="post">
    {{ csrf_field() }}
        @method('POST')
        <div class="form-group">
            <label for="text" class="review">レビュー投稿</label>
            <textarea id="text" class="form-control" name="text" rows="8" required placeholder="読んだ本のレビューを投稿しよう"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">{{ __('新規投稿') }}</button>
    </form>
    
</div>

@endsection