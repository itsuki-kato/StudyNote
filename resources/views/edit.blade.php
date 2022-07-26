@extends('layouts.app')

@section('edit')
<h2>新規作成</h2>
<div class="create_new">
    <form action="{{ route('edit_save', ['id' => $Text->id]) }}" method="post">
        {{ csrf_field() }}
        <div>
            <p>カテゴリ</p>
            <select name="category">
                @foreach($Categories as $Category)
                    @if ($Category->name === $targetCategoryName)
                        <option value="{{ $Category->id }}" selected="selected">{{ $Category->name }}</option>
                    @else
                        <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="title_edit">
            <p>タイトル</p>
            <textarea name="title" id="" cols="30" rows="2">{{ old('description', $Text->title) }}</textarea>
        </div>
        <p>本文</p>
        <div class="text_edit">
            <textarea name="text" id="" cols="30" rows="10">{{ old('description', $Text->text) }}</textarea>
        </div>
        <p><input type="submit" value="変更を保存する"></p>
        <input type="hidden" name="mode" value="edit_mode">
        <p><a href="{{ url('/home') }}">homeに戻る</a></p>
    </form>
</div>
@endsection
