@if(Session::has('message'))
    <div class="row ">
        <p class="alert alert-success col text-center">
            {{Session::get('message')}}
        </p>
    </div>
@endif
