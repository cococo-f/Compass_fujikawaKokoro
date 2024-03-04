@extends('layouts.sidebar')

@section('content')
<div class="pt-5" style="background:#ECF1F6;">
  <div class="w-75 m-auto pt-5 pb-5 border" style="border-radius:5px; background:#FFF;">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <div class="w-75 m-auto" style="border-radius:5px;">
    <p>{!! $calendar->render() !!}</p>
    </div>
  </div>
</div>
@endsection