@csrf


@if ($negocio->img)

<div class="w-100 text-center">
    <i>Imagen actual del negocio</i> <br>
    <img class="img-thumbnail" src="{{ $negocio->img }}" alt="">
</div>
<br><br>
@endif

<div class="form-group">
    <label for="name"><b>Nombre del negocio</b></label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Escribe el nombre del negocio"
        value="{{old('name',$negocio->name)}}" />
    @error('name')
    <small class="text-danger">
        {{$message}}
    </small>
    @enderror
</div>

@if (Auth::user()->rol == "admin")
<div class="form-group">

    <label for="owner_id"><b>Dueño del negocio</b></label>
    <select class="form-control" name="owner_id" id="owner_id">
        <option @if (is_null($negocio->owner_id ))
            selected
            @endif disabled>Seleccione un dueño</option>
        @foreach ($owners as $owner)
        <option @if (old('owner_id',$negocio->owner_id) == $owner->id)
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
@else
<input type="hidden" class="form-control" name="owner_id" id="owner_id" value="{{Auth::user()->id}}" />
@endif

<div class="form-group">
    <label for="name"><b>Teléfono del negocio</b></label>
    <input type="text" class="form-control" name="phone" id="phone" placeholder="Teléfono del negocio"
        value="{{old('phone',$negocio->phone)}}" />
    @error('phone')
    <small class="text-danger">
        {{$message}}
    </small>
    @enderror
</div>


<div class="form-group">
    <label for="name"><b>Dirección del negocio</b></label>
    <input type="text" class="form-control" name="address" id="address" placeholder="Dirección del negocio"
        value="{{old('address',$negocio->address)}}" />
    @error('address')
    <small class="text-danger">
        {{$message}}
    </small>
    @enderror
</div>

<div class="form-group">
    <label for="email"><b>Correo del negocio</b></label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Correo del negocio"
        value="{{old('email',$negocio->email)}}" />
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
    <input type="file" class="form-control" name="img" id="img" placeholder="Subir archivo"
        aria-describedby="fileHelpId" />
    @error('img')
    <small class="text-danger">
        {{$message}}
    </small>
    @enderror
</div>

@if (Auth::user()->rol == "admin")
    <div class="form-group">
        <label for="name"><b>Latitud</b></label>
        <input type="text" class="form-control" name="latitud" id="latitud" placeholder="Latitud del negocio"
            value="{{old('latitud',$negocio->latitud)}}" />
        @error('latitud')
        <small class="text-danger">
            {{$message}}
        </small>
        @enderror
    </div>
    <div class="form-group">
        <label for="name"><b>Longitud</b></label>
        <input type="text" class="form-control" name="longitud" id="longitud" placeholder="Longitud del negocio"
            value="{{old('longitud',$negocio->longitud)}}" />
        @error('longitud')
        <small class="text-danger">
            {{$message}}
        </small>
        @enderror
    </div>
@endif

@if (Auth::user()->rol == "admin")
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
@else
    <div >
        <input type="hidden" name="tipos[]" value="2">
    </div>
@endif

<br>


<script>

    window.onload = function () {
        addLocation();
    }

    async function addLocation() {
        let result = await navigator.permissions.query({ name: "geolocation" });

        if (result.state === "granted" || result.state == "prompt") {

            navigator.geolocation.getCurrentPosition(location => {
                let lat = location.coords.latitude;
                let long = location.coords.longitude;
                insertLocation(lat, long);
            });
        }
    }
    function insertLocation(lat, long) {
       
        $("#form-create").append(
            `<input type="hidden"   name='latitud'  value=${lat} />`
        );
        $("#form-create").append(
            `<input type="hidden"  name='longitud'  value=${long} />`
        );
    }

</script>