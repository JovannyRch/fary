
    @include('admin.partials.validation-error')
    @csrf
    @if ($ad->url)

      <div class="w-100 text-center">
      
        @if ($ad->isVideo())
          <i>Video actual</i> <br>
          <video width="400" controls>
            <source src="{{ $ad->url }}" type="video/mp4"> 
          </video>
        @else
          <i>Imagen actual</i> <br>
          <img class="img-thumbnail" src="{{ $ad->url }}" alt="">
        @endif
      </div>
    @endif
    <div class="form-group">
        <label for="file"><b>Imagen o video</b></label>
        <input
            type="file"
            class="form-control"
            name="file"
            id="file"
            placeholder="Cargue el video o imagen"
           
        />
        
        @error('file')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>

    <div class="form-group">
      <label for=""><b>Seleccione tiempo de aparición</b></label>
      <select class="form-control" name="tiempo" id="">
        <option   value="7" @if (is_null($ad->tiempo  ||  old('tiempo',$ad->tiempo) == 7 ))
            selected
        @endif > 7 segundos</option>

        <option   value="10"
      @if (old('tiempo',$ad->tiempo) == 10 )
            selected
        @endif > 10 segundos</option>

        <option   value="15"
        @if (old('tiempo',$ad->tiempo) == 15 )
              selected
          @endif > 15 segundos</option>
      </select>
    </div>

    <div class="form-group">
      <label for=""><b>Seleccione el negocio</b></label>
      <select class="form-control" name="negocio_id" id="">
        <option @if (!$ad->negocio)
          selected
          required
        @endif disabled>Seleccione un negocio</option>
        @foreach ($negocios as $negocio)
            <option @if ($ad->negocio && $ad->negocio->id == $negocio->id)
                selected
            @endif   value="{{ $negocio->id }}">{{ $negocio->name }}</option>
        @endforeach
      </select>
    </div>




