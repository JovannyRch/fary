@extends('admin.master') @section('content')


<div class="card">
    <div class="card-header bg-dark text-white">
        Usuarios
    </div>
    <div class="card-body">
        <div class="float-right">
            Total de registros: <b>{{ sizeof($users)}}</b>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ucwords($user->name)}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->rol}}</td>
                        <td>
                    
                            <a type="button" href="{{route('user.edit',$user->id)}}" >
                                Editar
                            </a>
                        <a href="#" data-toggle="modal" data-target="#delete-user" data-action="{{route('user.destroy','')}}" data-name="{{$user->name}}"  data-id="{{$user->id}}" >
                           Eliminar
                        </a>
            
                         
                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 text-center" >
            {{ $users->links() }}
        </div>
        <div class="col-4"></div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="delete-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">Confirmar eliminación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    ¿Estás seguro de eliminar el registro seleccionado?
                </div>
            </div>
            <div class="modal-footer">
                <form  id="deleteForm" action="{{route('user.destroy',0)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-secondary text-white">Eliminar</button>
                </form>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                
               
                
            </div>
        </div>
    </div>
</div>


<script>
 window.onload = function(event){
     console.log("Hola");
    $('#delete-user').on('show.bs.modal', function (event) {
        console.log("hola");
        var button = $(event.relatedTarget) 
        var id = button.data('id') 
        var action = button.data('action') 
        var name = button.data('name') 
        console.log(action+"/"+id);
        $('#deleteForm').attr('action', action+"/"+id);
        var modal = $(this)
        modal.find('.container-fluid').html('Estás seguro de eliminar el usuario: <span style=" text-transform: capitalize; ">' + name + "</span>")
        
    }) 
 };
</script>

@endsection
