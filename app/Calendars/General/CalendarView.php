<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th class="day-sat">土</th>';
    $html[] = '<th class="day-sun">日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        // 過去か未来か
        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="calendar-td '.$day->getClassName().'" style="background-color:#EEE">';
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        

        // 予約されていれば　　〇部と表示
        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePartText = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePartText == 1){
            $reservePartText = "リモ1部";
          }else if($reservePartText == 2){
            $reservePartText = "リモ2部";
          }else if($reservePartText == 3){
            $reservePartText = "リモ3部";
          }
          // 予約されていて過去であれば〇部参加と表示
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'. $reservePartText .'参加'.'</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';

          // 予約されていて未来であればキャンセルボタン表示
          // buttonタグの中でモーダルのjsファイルに値を渡している
          // フォームにはリモ〇部ではなく値を表示させるため$reservePartを使う
          }else{
            $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
            $html[] = '<button type="submit" class="cancel-modal-open btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px"
            delete_day="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'"
            delete_reserve="'. $reservePart .'"
            value="'. $reservePartText .'" >'. $reservePartText .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }

        // 予約されていなければ
        }else{
          // 予約されてなく過去であれば受付終了と表示
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px; color: #000000;">受付終了</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';

          // 予約されていなく未来であればセレクトボックス表示
          }else{
          $html[] = $day->selectPart($day->everyDay());
          }
        }

        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    // formタグのidにルート名
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
