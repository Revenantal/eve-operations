
@if(count($errors) > 0)
    <div class="container">
        <div class="alert alert-danger" role="alert">
            The following errors have occured:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</lI>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="container">
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    </div>
@endif