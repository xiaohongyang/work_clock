@if(count($errors))
    @foreach($errors->all() as $error)
        <div class="rows">
            <div class="col-md-12 col-md-offset-0 has-error">
                {{$error}}
            </div>
        </div>
    @endforeach
@endif


@if(session('message'))
    <div class="rows">
        <div class=" alert alert-success ">
            {{ session('message') }}
        </div>
    </div>
@endif
