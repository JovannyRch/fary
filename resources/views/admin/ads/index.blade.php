@extends('admin.master') @section('content')

<div class="card">
    <div class="card-header bg-dark text-white">
      Publicidad
        
    </div>
    <div class="card-body">
        @if ($total > 0)
            <div class="float-right">
                Total de registros: <b>{{ $total }}</b>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th >Recurso</th>
                            <th>Negocio</th>
                            <th>Segundos</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ads as $ad)
                        <tr>
                            <td>
                                @if ($ad->isVideo())
                                    <video width="400" controls>
                                        <source src="{{ $ad->url }}" type="video/mp4">
                                            
                                    </video>
                                @else
                                    <img src="{{ $ad->url }}" class="img-thumbnail"  alt="Anuncio de {{ $ad->negocio }}" >
                                @endif
                            </td>
                            <td>
                                <b>{{ $ad->negocio? $ad->negocio->name: ''}}</b>
                            </td>
                            <td>
                                {{ $ad->tiempo }} segundos
                            </td>
                            <td>
                                
                                
                                <a   href="{{route('ads.edit',$ad->id)}}" >
                                    Editar
                                </a>
                                <br>
                                <a href="#" data-toggle="modal" data-target="#delete-ad" data-action="{{route('ads.destroy','')}}"   data-id="{{$ad->id}}" >
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
                    {{ $ads->links() }}
                </div>
                <div class="col-4"></div>
            </div>
        @else
            <div class="alert alert-warning">
                No se han encontrado registros
            </div>
        @endif
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="delete-ad" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title ">Confirmar eliminación</h5>
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

                <form  id="deleteForm" action="{{route('ads.destroy',0)}}" method="post">
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
    $('#delete-ad').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget) 
        var id = button.data('id') 
        var action = button.data('action') 
        console.log(action+"/"+id);
        $('#deleteForm').attr('action', action+"/"+id);
       
        var modal = $(this)
        modal.find('.container-fluid').text('¿Estás seguro de eliminar el registro?'  )
        
    }) 
 };
</script>

@endsection
