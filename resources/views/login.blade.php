@extends('layouts.main')
@include('layouts.header')


@section('content')

    @include('layouts.message-block')
    <h4><a href="{{route('register')}}">注册用户</a></h4>

<form action="{{ route('doSignOn') }}" method="post">
    <div class="form-group">
        <label>Email</label>
        <input class="input-control" type="text" name="email" id="email" />
    </div>
    <div class="form-grou">
        <label for="password">密码</label>
        <input type="text" class="input-control" name="password" id="password">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">提交</button>
        <input type="text" name="_token" value ="{{ \Illuminate\Support\Facades\Session::token()  }}">
    </div>
</form>
@endsection