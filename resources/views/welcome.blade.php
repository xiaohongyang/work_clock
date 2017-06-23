
@extends('layouts.main')
@include('layouts.header')

@include('layouts.message-block')


@section('title')
hihi!
@stop

@php
$totalWorkTime = 0;
$totalAddTime = 0;
@endphp

 @section('content')
     <h4>Hello World!</h4>
 @stop
