@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- 検索フォーム -->
            <form action="{{ route('home') }}" method="get">
                @csrf
                <div class="header_input_search">
                    <input id="search_form" name="keyword" type="text" value="{{ $keyword }}">
                    <p><input id="search_btn" type="submit" value="search"></p>
                </div>
            </form>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>学習メモ</span>
                        <i class="fa-solid fa-cat" style="color: white;"></i>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="lists_wrapper">
                            <ul id="sortable">
                                @foreach($Texts as $Text)
                                <li id="{{ $Text->id }}" class="list sortable-item" data-text-id="{{ $Text->id }}" data-sort-no="{{ $Text->sort_no }}">
                                    <div class="list_wrapper">
                                            <table class="content_table">
                                                <tr>
                                                    @foreach($Categories as $Category)
                                                        @if($Text->category_id == $Category->id)
                                                            <a href="{{ route('home', ['category_id' => $Category->id]) }}">
                                                                <span class="category_lavel">{{ $Category->name }}</span>
                                                            </a>
                                                            <!-- 一致した時点でブレークする -->
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <th>Title</th>
                                                    <td class="font-weight-bold">{{ $Text->title }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="list_item">Content</th>
                                                    <td>{!! nl2br(e($Text->text)) !!}</td>
                                                    <tr class="edit">
                                                        <th></th>
                                                        <td>
                                                            <textarea name="text" id="" cols="30" rows="10">{{ old('description', $Text->text) }}</textarea>
                                                        </td>
                                                    </tr>
                                                </tr>
                                            </table>
                                            <tr>
                                                <td>
                                                    <div class="button_wrapper">
                                                        <a href="{{ route('edit', ['id' => $Text->id]) }}">
                                                            <button id="edit_btn" type="button">編集</button>
                                                        </a>
                                                        <form action="{{ route('delete', ['id' => $Text->id]) }}" method="post">
                                                            <!-- これがないとエラーになる -->
                                                            @method('DELETE')
                                                            @csrf
                                                            <p><button id="delete_btn" type="submit">削除</button></p>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </div>
                                        </li>
                                @endforeach
                                {{ $Texts->appends(request()->query())->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
