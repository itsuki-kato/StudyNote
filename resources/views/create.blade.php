@extends('layouts.app')

@section('create')
<h2>新規作成</h2>
<div class="create_new">
    <form action="{{ url('/create/new') }}" method="post">
        {{ csrf_field() }}
        <div>
            <p>カテゴリ</p>
            <select name="category">
                @foreach($Categories as $Category)
                    <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="title_create">
            <p>タイトル</p>
            <textarea name="title" id="" cols="30" rows="2"></textarea>
        </div>
        <p>本文</p>
        <div class="text_create">
            <textarea name="text" id="" cols="30" rows="10"></textarea>
        </div>
        @foreach ($errors->all() as $error)
            <p class="error_message">{{ $error }}</p>
        @endforeach
        <p><input type="submit" value="新規作成"></p>
        <input type="hidden" name="mode" value="create_new">
        <p><a href="{{ url('/home') }}">homeに戻る</a></p>
    </form>
</div>
@endsection
