@extends('layouts.sidebar')

@section('content')
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="">
      <p class="mb-0">カテゴリー</p>
      <!-- 投稿サブカテゴリー表示 -->
      <select class="form-select w-100" name="main_category_id" form="subCategoryRequest">
        <option disabled selected>選択してください</option>
        @foreach($categories as $main_category)
        <option disabled selected="{{ $main_category->main_category }}">
        {{ $main_category->main_category }}
        </option>
        @foreach($sub_categories as $sub_category)
        <option value="{{ $sub_category->sub_category }}">
        @if($main_category->id === $sub_category->main_category_id )
        <span>{{$sub_category->sub_category}}</span>
        @endif
        @endforeach
        @endforeach
        </option>
      </select>
    </div>
    <div class="mt-3">
      @if($errors->first('post_title'))
      <span class="error_message">{{ $errors->first('post_title') }}</span>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
    </div>
    <div class="mt-3">
      @if($errors->first('post_body'))
      <span class="error_message">{{ $errors->first('post_body') }}</span>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
    <form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
  </div>
  @can('admin')
  <div class="w-25 ml-auto mr-auto">
    <div class="category_area mt-5 p-5">
      <div class="">
        <p class="m-0">メインカテゴリー</p>
        <input type="text" class="w-100" name="main_category" form="mainCategoryRequest">
        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="mainCategoryRequest">
      </div>
      <form action="{{ route('main.category.create') }}" method="post" id="mainCategoryRequest">{{ csrf_field() }}</form>
      @if($errors->first('main_category'))
      <span class="error_message">{{ $errors->first('main_category') }}</span>
      @endif
      <!-- サブカテゴリー -->
      <!-- メインカテゴリーの選択 -->
      <p class="m-0">サブカテゴリー</p>
      <!-- ↓formタグのidとinputタグのformが一致することで値を送ることができる↓ -->
      <select class="form-select" name="main_category_id" form="subCategoryRequest">
        <option value="" selected="selected">選択してください</option>
        @foreach($categories as $main_category)
        <option value="{{ $main_category->id }}">
        {{ $main_category->main_category }}
        </option>
        @endforeach
      </select>
      <!-- サブカテゴリーの追加 -->
      <input type="text" class="w-100" name="sub_category" form="subCategoryRequest">
      <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="subCategoryRequest">
      <form action="{{ route('sub.category.create') }}" method="post" id="subCategoryRequest">{{ csrf_field() }}</form>
      <!-- エラーメッセージ -->
      @if($errors->first('main_category_id'))
      <p class="error_message">{{ $errors->first('main_category_id') }}</p>
      @endif
      @if($errors->first('sub_category'))
      <p class="error_message">{{ $errors->first('sub_category') }}</p>
      @endif
    </div>
  </div>
  @endcan
</div>
@endsection
