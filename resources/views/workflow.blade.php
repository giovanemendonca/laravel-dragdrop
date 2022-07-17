<!doctype html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>jQuery UI Draggable - Default functionality-nicesnippets.com</title>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

      <style>
        #draggable { 
            width: 150px;
            height: 150px;
            padding: 0.5em;
        }       
        
        
        
      </style>
    </head>
    <body class="bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                <h2 class="text-center pb-3 pt-1">Arraste e solte os candidatos entre as etapas:</h2>
                <div class="row">
                    <div class="col-md-4 p-3 bg-dark offset-md-1">
                        <h2 class="text-white">Etapa 1: Análise de Currículos </h2> 
                        <ul class="dropzone list-group shadow-lg connectedSortable" id="padding-item-drop">
                            <h3 style="height: 15px"></h3>
                            @if(!empty($panddingItem) && $panddingItem->count())
                              @foreach($panddingItem as $key=>$value)
                                <li class="content list-group-item" item-id="{{ $value->id }}">{{ $value->title }}</li>
                              @endforeach
                            @endif                            
                        </ul>
                    </div>
                    <div class="col-md-4 p-3 bg-dark offset-md-1 shadow-lg">
                        <h2 class="text-white">Etapa 2: Entrevistas</h2> 
                        <ul class="dropzone list-group connectedSortable" id="complete-item-drop">
                            <h3 style="height: 15px"></h3>
                            @if(!empty($completeItem) && $completeItem->count())
                              @foreach($completeItem as $key=>$value)
                                <li class="content list-group-item" item-id="{{ $value->id }}" draggable="false">{{ $value->title }}</li>
                              @endforeach
                            @endif
                        </ul>
                    </div>                    
                </div>
            </div>
          </div>
        </div> 
        
        <div class="bords">
            <div class="board">
                <h3>Análise de Currículos:</h3>
                <div class="dropzone highlight" id="analisecurriculo">
                    <div class="card connectedSortable">
                        @if(!empty($panddingItem) && $panddingItem->count())
                            @foreach($panddingItem as $key=>$value)
                            <div class="content" item-id="{{ $value->id }}" id="{{ $value->id }}" draggable="false">
                              {{ $value->title }}
                              </div>                               
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bords">
            <div class="board">
                <h3>Entrevista:</h3>
                <div class="dropzone highlight" id="entrevista">
                    <div class="card connectedSortable">                        
                        @if(!empty($completeItem) && $completeItem->count())
                            @foreach($completeItem as $key=>$value)
                                <div class="content" item-id="{{ $value->id }}" id="{{ $value->id }}" draggable="true">
                                    {{ $value->title }}
                                </div> 
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        
          <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        
        <script>
            /**EXEMPLO VÍDEO YOUTUBE: https://www.youtube.com/watch?v=6wn8hpUcEcM **/
            
           $( "#padding-item-drop, #complete-item-drop" ).sortable({
                connectWith: ".connectedSortable",
                opacity: 0.5,            
            }).disableSelection();
              
              const contents = document.querySelectorAll('.content')
              const dropzones = document.querySelectorAll('.dropzone')
              
              /**Nossos cartões**/
              contents.forEach(content =>{
                  content.addEventListener('dragstart', dragstart)
                  content.addEventListener('drag', drag)
                  content.addEventListener('dragend', dragend)
              })
              
              function dragstart(){
                //console.log('Start drag')
                dropzones.forEach( dropzone => dropzone.classList.add('highlight'))

                //o this se refere ao content que chamou esta função
                this.classList.add('is-dragging')
                var idCandidato = $(this).attr('id');
                console.log(idCandidato);

                /** local onde soltar os cartões**/
                dropzones.forEach(dropzone =>{
                    dropzone.addEventListener('dragover', soltarCandidato)
                })
              }
              
              function soltarCandidato(){
                  console.log('soltarCandidato')
                  //this é o dropzone
                  this.classList.add('over')
                  //pega o cartão que está sendo arrastado
                  const cardBeingDragged = document.querySelector('.is-dragging')
                  
                  //verifica o valor do id da dragzone para onde o item foi arrastado
                  var dragzoneDestino = $(this).attr('id');
                  console.log(dragzoneDestino);  
                  
                  //this é o dropzone
                  this.appendChild(cardBeingDragged);
                  
              }
              
              function drag(){
                 //console.log('Drag')                  
              }
              
              function dragend(){
                  //console.log('End drag')  
                  dropzones.forEach( dropzone => dropzone.classList.remove('highlight'))
                  
                  //o this se refere ao content que chamou esta função
                  this.classList.remove('is-dragging')
              }
              
              /** local onde soltar os cartões**/
              dropzones.forEach(dropzone =>{
                  dropzone.addEventListener('dragenter', dragenter)
                  //dropzone.addEventListener('dragover', dragover)
                  dropzone.addEventListener('dragleave', dragleave)
                  dropzone.addEventListener('drop', drop)
              })
              
              function dragenter(){
                  //console.log('Dragenter')
                  
              } 
              
              /**Quando estiver em cima das dragzone*/
              function dragover(){
                  console.log('Dragover')
                  //this é o dropzone
                  this.classList.add('over')
                  //pega o cartão que está sendo arrastado
                  const cardBeingDragged = document.querySelector('.is-dragging')
                  
                  //verifica o valor do id da dragzone para onde o item foi arrastado
                  var dragzoneDestino = $(this).attr('id');
                  console.log(dragzoneDestino);  
                  
                  //this é o dropzone
                  this.appendChild(cardBeingDragged);
                  
              }
              
              /**Quando estiver fora das dragzone*/
              function dragleave(){
                  //console.log('Dragleave')
                  this.classList.add('over')
              }
              
              function drop(){
                  console.log('Drop')
              }
          
        </script>
    </body>
</html>
