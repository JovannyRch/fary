@extends('admin.master') @section('content')

    <div class="card">
        <div class="card-header bg-dark text-white">
            Detalles de la publicación
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 ">
                    <h3 class="title"><b>{{ $car->content }}</b> </h3>
                   <div class="text-right pr-3">
                    <i>
                        Publicado el  {{$car->created_at->format('d-m-Y')}}
                    </i>
                    <br>
                    <i>
                        Por: {{ ucwords($car->user->name) }}
                    </i>
                   </div>
               </div>
                <div class="col-12 col-md-12 text-center">
                    @foreach ($car->imgs as $img)
                       
                       <div class="card">
                           <div class="float-right">
                                Eliminar
                           </div>
                           <div class="card-body">
                            <img src="{{ $img->url }}" class="img-fluid" > 
                           </div>
                       </div>
                    @endforeach
                </div>
               
            </div>
            <h5><b>Comentarios</b></h5>
           
            @forelse ($car->comments as $c)
            <div class="card bg-light pt-1">
                <div class="text-right mr-2">
                  
                       <a data-toggle="modal" data-target="#delete-register" data-action="{{route('comment.car.destroy','')}}" data-content="{{$c->content}}"  data-id="{{$c->id}}" >
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
                        <form  id="deleteForm" action="{{route('comment.car.destroy',0)}}" method="post">
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