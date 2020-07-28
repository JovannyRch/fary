@extends('admin.master') @section('content')

<div class="card">
    <div class="card-header bg-dark text-white">
      Autopartes
    </div>
    <div class="card-body">
        <a class="btn btn-info float-left" href="/admin/posts/latest">Ver publicaciones con más de 3 meses de antigüedad</a>
        <div class="float-right">
            Total de registros: <b>{{ $total }}</b>
        </div>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Contenido</th>
                       
                        <th >Usuario</th>
                        <th >Cantidad de comentarios</th>
                        <th >Fecha de creación</th>
                        <th >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>
                            @if ($post->img)
                                <img src="{{$post->img}}" alt="" height="50px">
                                <br>
                            @endif
                            <b>{{$post->content}}</b>
                        </td>
                      
                        <td>{{ucwords($post->username)}}</td>
                        <td>{{$post->comments}}</td>
                        <td>{{$post->created_at->format('d-m-Y')}}</td>
                        <td>
                    
                            <a type="button" href="{{route('post.show',$post->id)}}" >
                                Ver
                            </a>
                        <a href="#" data-toggle="modal" data-target="#delete-data" data-action="{{route('post.destroy','')}}" data-name="{{$post->content}}"  data-id="{{$post->id}}" >
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
                {{ $posts->links() }}
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="delete-data" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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

                <form  id="deleteForm" action="{{route('post.destroy',0)}}" method="post">
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
    
    $('#delete-data').on('show.bs.modal', function (event) {
       
        var button = $(event.relatedTarget) 
        var id = button.data('id') 
        var action = button.data('action') 
        var name = button.data('name');
        $('#deleteForm').attr('action', action+"/"+id);
        var modal = $(this)
        modal.find('.container-fluid').text('Estás seguro de la publicación: ' + name )
        
    }) 
 };
</script>

@endsection
