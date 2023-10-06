@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
<!-- キャンセルモーダルの中身 -->
<!-- 予約日や時間はjsファイルの値をクラス名で受け取っている -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content w-50 m-auto">
      <div class="w-100">
        <div class="w-50 m-auto">予約日：
        <span class="modal-inner-day w-50 m-auto">
        </span>
        <input type="hidden" name="delete_day" form="deleteParts" class="w-100 delete_day" value="">
        </div>
        <div class="w-50 m-auto">時間：
        <span class="modal-inner-reserve w-50 m-auto pt-3 pb-3">
        </span>
        <input type="hidden" name="delete_reserve" form="deleteParts" class="w-100 delete_part" value="">
        </div>
        <div class="w-50 m-auto">上記の予約をキャンセルしてもよろしいですか？</div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="delete_id" value="">
          <input type="submit" class="btn btn-primary d-block" form="deleteParts" value="キャンセル">
        </div>
      </div>
  </div>
</div>
@endsection
