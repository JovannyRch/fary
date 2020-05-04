
    @include('admin.partials.validation-error')
    @csrf
    <div class="form-group ">
        <label for="name">Nombre</label>
        <input
            type="text"
            class="form-control"
            name="name"
            id="name"
            placeholder="Escribe el nombre del usuario"
            value="{{old('name',$user->name)}}"
        />
        @error('name')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>

    <div class="form-group">
        <label for="name">Teléfono</label>
        <input
            type="text"
            class="form-control"
            name="phone"
            id="phone"
            placeholder="Teléfono del usuario"
            value="{{old('phone',$user->phone)}}"
        />
        @error('phone')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>


    <div class="form-group">
        <label for="name">Dirección</label>
        <input
            type="text"
            class="form-control"
            name="address"
            id="address"
            placeholder="Dirección del usuario"
            value="{{old('address',$user->address)}}"
        />
        @error('address')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Correo</label>
        <input
            type="email"
            class="form-control"
            name="email"
            id="email"
            placeholder="Escribe el correo"
            value="{{old('email',$user->email)}}"
        />
        @error('title')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>

    <div class="form-group">
        <label for="rol">Seleccionar tipo de usuario</label>
        <select class="custom-select" name="rol" id="rol">
            <option value="normal" @if ($user->rol == 'normal')selected @endif> Usuario normal </option>
            <option value="owner" @if ($user->rol == 'owner')selected @endif>Dueño de negocios</option>
            <option value="admin" @if ($user->rol == 'admin')selected @endif>Administrador</option>
        </select>
    </div>

   @if ($pass)
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input
            type="password"
            class="form-control"
            name="password"
            id="password"
            placeholder="Escribe la contraseña"
            value="{{old('password',$user->password)}}"
        />
        @error('title')
            <small class="text-danger">
                {{$message}}
            </small>
        @enderror
    </div>
   @endif


