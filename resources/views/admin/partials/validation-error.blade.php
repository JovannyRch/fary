@if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $e)
                {{$e}}
            @endforeach
        </div>
    @endif