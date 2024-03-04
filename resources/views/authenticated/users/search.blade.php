@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100 border d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div>
        <span>ID : </span><span class="profile-text">{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a class="profile-name" href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span class="profile-text">{{ $user->over_name }}</span>
          <span class="profile-text">{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span class="profile-text">({{ $user->over_name_kana }}</span>
        <span class="profile-text">{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span class="profile-text">男</span>
        @else
        <span>性別 : </span><span class="profile-text">女</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span class="profile-text">{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span class="profile-text">教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span class="profile-text">教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span class="profile-text">講師(英語)</span>
        @else
        <span>権限 : </span><span class="profile-text">生徒</span>
        @endif
      </div>
      <div>
        <span>選択科目 :
        @if($user->role == 4)
        @foreach($user->subjects as $subject)
        <span class="profile-text">{{ $subject->subject }}</span>
        @endforeach
        </span>
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25 border">
    <div class="">
        <p class="navy-text user_search-text">検索</p>
        <input type="text" class="free_word input_border" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      <div>
        <label class="navy-text search_item">カテゴリ</label>
        <select form="userSearchRequest" name="category" class="user_search_select">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <label class="navy-text search_item">並び替え</label>
        <select name="updown" form="userSearchRequest" class="user_search_select">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="add_search">
        <input type="checkbox" id="menu_bar01" class="add_search_check input_border">
        <div class="m-0 search_conditions navy-text"><span>検索条件の追加</span></div>
        <div class="search_conditions_inner">
          <div class="search_sex">
            <label class="navy-text search_item">性別</label>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
          </div>
          <div>
            <label class="navy-text search_item">権限</label>
            <select name="role" form="userSearchRequest" class="engineer user_search_select">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
            <label class="navy-text search_item">選択科目</label>
            @foreach($subjects as $subject)
              <label>{{ $subject->subject }}</label>
              <input type="checkbox" name="subjects[]" form="userSearchRequest" value="{{ $subject->id }}">
            @endforeach
          </div>
        </div>
      </div>
      <div class="">
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest" class="search_btn input_border">
      </div>
      <div>
        <input type="reset" value="リセット" form="userSearchRequest" class="reset_btn">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection
