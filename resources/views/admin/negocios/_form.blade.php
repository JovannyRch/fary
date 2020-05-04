

    @csrf


    @if ($negocio->img)
    
        <div class="w-100 text-center" >
            <i>Imagen actual del negocio</i> <br>
            <img src="{{ $negocio->img }}" alt="">
        </div>
        <br><br>
    @endif

    <div class="form-group">
        <label for="name"><b>Nombre del negocio</b></label>
        <input
            type="text"
            class="form-control"
            name="name"
            id="name"
            placeholder="Escribe el nombre del negocio"
            value="{{old('name',$negocio->name)}}"
        />
        @error('name')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>
    
    <div class="form-group">
      
        <label for="owner_id"><b>Dueño del negocio</b></label>
        <select class="form-control" name="owner_id" id="owner_id">
          <option @if (is_null($negocio->owner_id ))
              selected
          @endif  disabled>Seleccione un dueño</option>
            @foreach ($owners as $owner)
                 <option  
                 @if (old('owner_id',$negocio->owner_id) == $owner->id)
                    selected
                @endif
                 value="{{ $owner->id }}"> {{ $owner->name }}</option>
            @endforeach
        </select>
        @error('owner_id')
        <small class="text-danger">
            {{$message}}
        </small>
    @enderror
    </div>

    <div class="form-group">
        <label for="name"><b>Teléfono del negocio</b></label>
        <input
            type="text"
            class="form-control"
            name="phone"
            id="phone"
            placeholder="Teléfono del negocio"
            value="{{old('phone',$negocio->phone)}}"
        />
        @error('phone')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>


    <div class="form-group">
        <label for="name"><b>Dirección del negocio</b></label>
        <input
            type="text"
            class="form-control"
            name="address"
            id="address"
            placeholder="Dirección del negocio"
            value="{{old('address',$negocio->address)}}"
        />
        @error('address')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>

    <div class="form-group">
        <label for="email"><b>Correo del negocio</b></label>
        <input
            type="email"
            class="form-control"
            name="email"
            id="email"
            placeholder="Correo del negocio"
            value="{{old('email',$negocio->email)}}"
        />
        @error('email')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>
    <div class="form-group col-12">
        <label for="img">
          <b>Foto o imagen</b>
        </label>
        <input
          type="file"
          class="form-control"
          name="img"
          id="img"
          placeholder="Subir archivo"
          aria-describedby="fileHelpId"
        />
        @error('img')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
      </div>
      <div class="form-group">
        <label for=""><b>Tipo de negocio</b></label>
        <br>
        @foreach ($tipos as $tipo)
        <div class="form-check form-check-inline">
            <input @if (in_array($tipo->id, $negocio->tipos_id() ))
                checked
            @endif class="form-check-input" name="tipos[]" type="checkbox" id="inlineCheckbox1" value="{{ $tipo->id }}">
            <label class="form-check-label" for="inlineCheckbox1">{{ $tipo->name }}</label>
        </div>
      @endforeach
      </div>
        
      
      <br>
      <br>
      <script>

            window.onload(function(event){
              
            });
       
      </script>