@extends('admin.master') @section('content')

<div class="card">
    <div class="card-header bg-dark text-white">
        Negocios

    </div>
    <div class="card-body">
        @if ($total)
        <div class="float-right">
            Total de registros: <b>{{ $total }}</b>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Detalles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($negocios as $negocio)
                    <tr>
                        <td style="max-width: 100px">
                            <img class="img-thumbnail" src="{{$negocio->img}}" alt="">
                        </td>
                        <td><b>{{$negocio->name}}</b></td>
                        <td>
                            <small>
                                {{$negocio->phone}} <br>
                                {{$negocio->email}} <br>
                                {{$negocio->address}} <br>
                                {{ucwords($negocio->username)}}
                            </small>
                        </td>
    
                        <td>
    
                            <a   href="{{route('negocios.edit',$negocio->id)}}" >
                                Editar
                            </a>
                            <br>
                            <a href="#" data-toggle="modal" data-target="#delete-user"
                                data-action="{{route('negocios.destroy','')}}" data-name="{{$negocio->name}}"
                                data-id="{{$negocio->id}}">
                                Eliminar
                            </a>
    
    
    
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                {{ $negocios->links() }}
            </div>
            <div class="col-4"></div>
        </div>
        @else
        <div class="alert alert-warning">
            No se encontraron registros
        </div>
        @endif
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

                <form id="deleteForm" action="{{route('negocios.destroy',0)}}" method="post">
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
    window.onload = function (event) {

        $('#delete-user').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            var action = button.data('action')
            var name = button.data('name')
            console.log(action + "/" + id);
            $('#deleteForm').attr('action', action + "/" + id);
            var modal = $(this)
            modal.find('.container-fluid').text('Estás seguro de eliminar el negocio: ' + name)

        })
    };
</script>

@endsection