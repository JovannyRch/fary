
    @include('admin.partials.validation-error')
    @csrf
    <div class="form-group ">
        <label for="name"><b>Nombre del tipo de negocio</b></label>
        <input
            type="text"
            class="form-control"
            name="name"
            id="name"
            
            placeholder="Escribe el nombre"
            value="{{old('name',$tipo->name)}}"
        />
        @error('name')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>
