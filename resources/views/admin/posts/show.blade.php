@extends('admin.master') @section('content')

    <div class="card">
        <div class="card-header bg-dark text-white">
            Detalles de la publicación
        </div>
        <div class="card-body">
            <div class="row">
                <div @if ($post->img)
                    class="col-12 col-md-8 p-3"
                @else
                class="col-12 col-md-12 p-3"
                @endif>
                    <img src="{{ $post->img }}" class="img-fluid" > 
                </div>
                <div
                @if ($post->img)
                    class="col-12 col-md-4"
                @else
                class="col-12 col-md-12 p-3"
                @endif
                >
                     <h3 class="title"><b>{{ $post->piece }}</b> </h3>
                    <b>Importación: </b> 
                    @if ($post->national == 1)
                        Nacional
                    @else
                        Extranjero
                    @endif <br>
                    <b>Marca: </b> {{ $post->brand }} <br>
                    <b>Modelo: </b> {{ $post->model }} <br>
                    <b>Descripción: </b> 
                    <p>
                        {{ $post->details }} 
                    </p>
                    <br>
                    <i>
                        Publicado el  {{$post->created_at->format('d-m-Y')}}
                    </i>
                    <br>
                    <i>
                        Por: {{ ucwords($post->user->name) }}
                    </i>
                </div>
            </div>
            <h5><b>Comentarios</b></h5>
           
            @forelse ($post->comments as $c)
            <div class="card bg-light pt-1">
                <div class="text-right mr-2">
                  
                       <a data-toggle="modal" data-target="#delete-register" data-action="{{route('comment.destroy','')}}" data-content="{{$c->content}}"  data-id="{{$c->id}}" >
                            <span class="badge badge-dark p-2">  
                                <i class="fa fa-trash"></i>
                            </span>
                        </a>
                  
                   
                </div>
                <div class="card-body">
                    {{ $c->content }}
                    <div class="text-right">
                        <i><small>Comentado por:  {{ $c->username }}</small></i>
                    </div>
                </div>
               
            </div>
            @empty
                <div class="alert alert-dark"> Aún no tiene comentarios</div>
            @endforelse
           
        </div>
        <!-- Modal -->
        <div class="modal fade" id="delete-register" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title">Confirmar eliminación</h5>
                                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="text-white" aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            ¿Estás seguro de eliminar el comentario?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form  id="deleteForm" action="{{route('comment.destroy',0)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-secondary text-white">Eliminar</button>
                        </form>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<script>
    window.onload = function(event){
       
       $('#delete-register').on('show.bs.modal', function (event) {
     
           var button = $(event.relatedTarget) 
           var id = button.data('id') 
           var action = button.data('action') 
           var content = button.data('content') 
           $('#deleteForm').attr('action', action+"/"+id);
           var modal = $(this)
           modal.find('.container-fluid').text('Estás seguro de eliminar el comentario ' + content +" ?" )
           
       }) 
    };
   </script>

@endsection