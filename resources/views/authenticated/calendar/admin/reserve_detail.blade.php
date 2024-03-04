@extends('layouts.sidebar')

@section('content')
<div class="d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <p><span>{{$date}}日</span><span class="ml-3">{{$part}}部</span></p>
    <div class="border user_status p-3">
      <table class="detail_table">
        <tr class="text-center">
          <th class="detail">ID</th>
          <th class="detail">名前</th>
          <th class="detail">場所</th>
        </tr>
        @foreach($reservePersons->users as $user)
        <tr class="text-center detail_user">
          <td class="detail_id">{{$user->id}}</td>
          <td class="detail_name">{{$user->over_name}}{{$user->under_name}}</td>
          <td class="detail_place">リモート</td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection
