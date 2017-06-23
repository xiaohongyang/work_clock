@extends('layouts.main')
@include('layouts.header')


@section('content')

    @include('layouts.message-block')

    <h3>用户注册</h3>

    <form action="{{ route('doRegister') }}" method="post">
        <div class="form-group">
            <label for="name">name</label>
            <input class="input-control" type="text" name="name" id="name" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="input-control" type="text" name="email" id="email" />
        </div>
        <div class="form-grou">
            <label for="password">密码</label>
            <input type="text" class="input-control" name="password" id="password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">注册</button>
            <input type="text" name="_token" value ="{{ \Illuminate\Support\Facades\Session::token()  }}">
        </div>
    </form>
@endsection