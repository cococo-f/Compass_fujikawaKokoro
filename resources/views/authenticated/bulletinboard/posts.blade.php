@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto"></p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p class="post_name"><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p class="post_title"><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        @foreach($post->subCategories as $sub_category)
            <p class="post_sub"><span>{{ $sub_category->sub_category }}</span></p>
        @endforeach
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i>
            <span class="">{{$post_comment->commentCounts($post->id)}}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">
            <!-- Like.php(モデル)を使えるようにする→その中のlikeCountsメソッドを使う。()内はpost_idと同じ。書き方が違うためややこしい。 -->
            <!-- view→modelに繋がっている(いいねを押すと発火) -->
            {{$like->likeCounts($post->id)}}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">
            <!-- いいねを外した時も同様 -->
            {{$like->likeCounts($post->id)}}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="border m-4">
      <div class="post_btn"><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="post_search">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest" class="post_search_window">
        <input type="submit" value="検索" form="postSearchRequest" class="post_search_btn">
      </div>
      <input type="submit" name="like_posts" class="like_category_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="my_category_btn" value="自分の投稿" form="postSearchRequest">
      <ul>
        <!-- メインカテゴリーのidとサブカテゴリーに登録されているメインカテゴリーidが一致したものを繰り返し表示 -->
        <p class="category_search">カテゴリー検索</p>
        <div class="menu">
        @foreach($categories as $main_category)
        <label for="menu_bar" class="main_categories" category_id="{{ $main_category->id }}">{{ $main_category->main_category }}
        </label>
        @foreach($sub_categories as $sub_category)
        @if($main_category->id === $sub_category->main_category_id )
        <ul id="links">
        <li>{{$sub_category->sub_category}}</li>
        <input type="submit" name="category_word" class="category_btn" value="{{$sub_category->sub_category}}" form="postSearchRequest">
        </ul>
        @endif
        @endforeach
        @endforeach
        </div>
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
