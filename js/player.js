

$(document).ready(function(){
   var wavesurfer = WaveSurfer.create({
        container: '#waveform'
    });

    wavesurfer.load('mp3/Primal_Scream_-_Loaded.mp3');
  
    
   
    $('#boton').click(function(){
        
        wavesurfer.play();
        $(this).toggleClass("#pause");
    });
});