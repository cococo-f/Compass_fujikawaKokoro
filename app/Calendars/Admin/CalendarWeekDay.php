<?php
namespace App\Calendars\Admin;

use Carbon\Carbon;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\ReserveSettingUsers;

class CalendarWeekDay{
  protected $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));
  }

  function render(){
    return '<p class="day">' . $this->carbon->format("j") . '日</p>';
  }

  function everyDay(){
    return $this->carbon->format("Y-m-d");
  }

  function dayPartCounts($ymd){
    $html = [];
    $one_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();
    $two_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();
    $three_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();



    $html[] = '<div class="text-left">';
    // 絶対に変数が中にある状態（if文の中）で記述
    // if文の外に出すとnullでエラーになったので注意
    if($one_part){
      $one_part_count = $one_part->users->count();
      $html[] ='<div class="part_count_area">';
      $html[] = '<p class="day_part m-0 pt-1">1部</p>';
      $html[] = '<p class="part_count">';
      // リンク設置するとき{{}}の書き方はbladeでしか使えないから書き方注意！！
      // ルート名使いたいのであれば文字列と変数で区切る！！
      $html[] = '<a href=" ' .route('calendar.admin.detail', ['id' => auth()->user()->id, 'data' => $one_part->setting_reserve, 'part' => $one_part->setting_part]).'">';
      $html[] = $one_part_count;
      $html[] = '</a>';
      $html[] = '</p>';
      $html[] = '</div>';
    };

    if($two_part){
      $two_part_count = $two_part->users->count();
      $html[] ='<div class="part_count_area">';
      $html[] = '<p class="day_part m-0 pt-1">2部</p>';
      $html[] = '<p class="part_count">';
      $html[] = '<a href=" ' .route('calendar.admin.detail', ['id' => auth()->user()->id, 'data' => $two_part->setting_reserve, 'part' => $two_part->setting_part]).'">';
      $html[] = $two_part_count;
      $html[] = '</a>';
      $html[] = '</p>';
      $html[] = '</div>';
    }
    if($three_part){
      $three_part_count = $three_part->users->count();
      $html[] ='<div class="">';
      $html[] = '<p class="day_part m-0 pt-1">3部</p>';
      $html[] = '<p class="part_count">';
      $html[] = '<a href=" ' .route('calendar.admin.detail', ['id' => auth()->user()->id, 'data' => $three_part->setting_reserve, 'part' => $three_part->setting_part]).'">';
      $html[] = $three_part_count;
      $html[] = '</a>';
      $html[] = '</p>';
      $html[] = '</div>';
    }
    $html[] = '</div>';

    return implode("", $html);
  }


  function onePartFrame($day){
    $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first();
    if($one_part_frame){
      $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first()->limit_users;
    }else{
      $one_part_frame = "20";
    }
    return $one_part_frame;
  }
  function twoPartFrame($day){
    $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first();
    if($two_part_frame){
      $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first()->limit_users;
    }else{
      $two_part_frame = "20";
    }
    return $two_part_frame;
  }
  function threePartFrame($day){
    $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first();
    if($three_part_frame){
      $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first()->limit_users;
    }else{
      $three_part_frame = "20";
    }
    return $three_part_frame;
  }

  //
  function dayNumberAdjustment(){
    $html = [];
    $html[] = '<div class="adjust-area">';
    $html[] = '<p class="d-flex m-0 p-0">1部<input class="w-25" style="height:20px;" name="1" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">2部<input class="w-25" style="height:20px;" name="2" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">3部<input class="w-25" style="height:20px;" name="3" type="text" form="reserveSetting"></p>';
    $html[] = '</div>';
    return implode('', $html);
  }
}
