<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AtlasBulletinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="all_content">
  <div class="d-flex">
    <div class="sidebar">
      @section('sidebar')
      <p class="mypage-content"><a href="{{ route('top.show') }}"><img src="<?php echo asset('image/家のアイコン素材.png') ?>" alt="マイページ画像" class="mypage-image">マイページ</a>
    </p>
      <p class="logout-content"><a href="/logout"><img src="<?php echo asset('image/ログイン・サインインのアイコン素材 2.png') ?>" alt="ログアウト画像" class="logout-image">ログアウト</a></p>
      <p class="reserve-content"><a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}"><img src="<?php echo asset('image/カレンダーのフリーアイコン2.png') ?>" alt="スクール予約画像" class="reserve-image">スクール予約</a></p>
      <!-- 講師アカウントにのみ表示 -->
      @if (Auth::user()->role < 4 )
      <p class="check-content"><a href="{{ route('calendar.admin.show',['user_id' => Auth::id()])}}"><img src="<?php echo asset('image/calendar_check_24.png') ?>" alt="スクール予約確認画像" class="check-image">スクール予約確認</a></p>
      <p class="setting-content"><a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}"><img src="<?php echo asset('image/記事アイコン1.png') ?>" alt="スクール枠登録画像" class="setting-image">スクール枠登録</a></p>
      @endif

      <p class="bulletinboard-content"><a href="{{ route('post.show') }}"><img src="<?php echo asset('image/吹き出しのアイコン15.png') ?>" alt="掲示板画像" class="bulletinboard-image">掲示板</a></p>
      <p class="search-content"><a href="{{ route('user.show') }}"><img src="<?php echo asset('image/人物アイコン　チーム.png') ?>" alt="掲示板画像" class="search-image">ユーザー検索</a></p>
      @show
    </div>
    <div class="main-container">
      @yield('content')
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
</body>
</html>
