/**
 * Create a WaveSurfer instance.
 */
var wavesurfer;

/**
 * Init & load.
 */
document.addEventListener('DOMContentLoaded', function() {
    // Init wavesurfer
    wavesurfer = WaveSurfer.create({
        container: '#waveform',
        height: 100,
        pixelRatio: 1,
        scrollParent: true,
        normalize: true,
        minimap: true,
        backend: 'MediaElement',
        plugins: [
            WaveSurfer.regions.create(),
            WaveSurfer.minimap.create({
                height: 30,
                waveColor: '#ddd',
                progressColor: '#999',
                cursorColor: '#999'
            }),
            WaveSurfer.timeline.create({
                container: '#wave-timeline'
            })
        ]
    });
//                                                                    CARGAR CANCION
    wavesurfer.util
        .ajax({
            responseType: 'json',
            url: 'rashomon.json'
        })
        .on('success', function(data) {
            
            wavesurfer.load(
                ubicacionCancion,
                data
            );
        });
        
 
        
        
    /* Regions                                              CARGAR REGIONES DE AUDIO */

    wavesurfer.on('ready', function() {
        wavesurfer.enableDragSelection({
            color: randomColor(0.1)
        });

//        if (localStorage.regions) {
//            loadRegions(JSON.parse(localStorage.regions));
//        } else {
//           var data = JSON.parse(json_regiones);
//            wavesurfer.util
//                .ajax({
//                    responseType: 'json',
//                    url: 'annotations.json'
//                })
//                .on('success', function(data) {
                    loadRegions(json_regiones);
                    saveRegions();
                   
//                });
//        }
    });
    wavesurfer.on('region-click', function(region, e) {
        e.stopPropagation();
        // Play on click, loop on shift click
//        e.shiftKey ? region.playLoop() : region.play();               
    });
    wavesurfer.on('region-click', editAnnotation);
    wavesurfer.on('region-updated', saveRegions);
    wavesurfer.on('region-removed', saveRegions);
    wavesurfer.on('region-in', showNote);

    wavesurfer.on('region-play', function(region) {
        region.once('out', function() {
            wavesurfer.play(region.start);
            wavesurfer.pause();
        });
    });

    /* Toggle play/pause buttons. */
    var playButton = document.querySelector('#play');
    var pauseButton = document.querySelector('#pause');
    wavesurfer.on('play', function() {
        playButton.style.display = 'none';
        pauseButton.style.display = '';
    });
    wavesurfer.on('pause', function() {
        playButton.style.display = '';
        pauseButton.style.display = 'none';
    });
});

/**
 * Save annotations to localStorage.
 */
function saveRegions() {
    localStorage.regions = JSON.stringify(
        Object.keys(wavesurfer.regions.list).map(function(id) {
            var region = wavesurfer.regions.list[id];
            return {
                start: region.start,
                end: region.end,
                attributes: region.attributes,
                data: region.data
            };
        })
    );
}

/**
 * Load regions from localStorage.
 */
function loadRegions(regions) {
    regions.forEach(function(region) {
        region.color = randomColor(0.1);
        wavesurfer.addRegion(region);
    });
}

/**
 * Extract regions separated by silence.
 */
function extractRegions(peaks, duration) {
    // Silence params
    var minValue = 0.0015;
    var minSeconds = 0.25;

    var length = peaks.length;
    var coef = duration / length;
    var minLen = minSeconds / coef;

    // Gather silence indeces
    var silences = [];
    Array.prototype.forEach.call(peaks, function(val, index) {
        if (Math.abs(val) <= minValue) {
            silences.push(index);
        }
    });

    // Cluster silence values
    var clusters = [];
    silences.forEach(function(val, index) {
        if (clusters.length && val == silences[index - 1] + 1) {
            clusters[clusters.length - 1].push(val);
        } else {
            clusters.push([val]);
        }
    });

    // Filter silence clusters by minimum length
    var fClusters = clusters.filter(function(cluster) {
        return cluster.length >= minLen;
    });

    // Create regions on the edges of silences
    var regions = fClusters.map(function(cluster, index) {
        var next = fClusters[index + 1];
        return {
            start: cluster[cluster.length - 1],
            end: next ? next[0] : length - 1
        };
    });

    // Add an initial region if the audio doesn't start with silence
    var firstCluster = fClusters[0];
    if (firstCluster && firstCluster[0] != 0) {
        regions.unshift({
            start: 0,
            end: firstCluster[firstCluster.length - 1]
        });
    }

    // Filter regions by minimum length
    var fRegions = regions.filter(function(reg) {
        return reg.end - reg.start >= minLen;
    });

    // Return time-based regions
    return fRegions.map(function(reg) {
        return {
            start: Math.round(reg.start * coef * 10) / 10,
            end: Math.round(reg.end * coef * 10) / 10
        };
    });
}

/**
 * Random RGBA color.
 */
function randomColor(alpha) {
    return (
        'rgba(' +
        [
            ~~(Math.random() * 255),
            ~~(Math.random() * 255),
            ~~(Math.random() * 255),
            alpha || 1
        ] +
        ')'
    );
}

/**
 * Edit annotation for a region.
 */
function editAnnotation(region) {
    var form = document.forms.edit;
    form.style.opacity = 1;
    
                                                                                //CONVERTIR SEGUNDOS A FORMATO MIN:SEG

    var inicio_minutos = Math.floor(region.start / 60);
    var inicio_segundos = Math.round(region.start % 60);
    if(inicio_segundos < 10){
        inicio_segundos = "0"+inicio_segundos;
    };
   
    var fin_minutos = Math.floor(region.end / 60);
    var fin_segundos = Math.round(region.end % 60);
    if(fin_segundos < 10){
        fin_segundos = "0"+fin_segundos;
    };
    (form.elements.idcomentario.value =region.attributes.label),                      //PONER idcomentario EN FORM
    (form.elements.start.value = inicio_minutos+":"+inicio_segundos),
        (form.elements.end.value =  fin_minutos+":"+fin_segundos);
    form.elements.note.value = region.data.note || '';
    form.onsubmit = function(e) {
        e.preventDefault();
        region.update({
            idcomentario: form.elements.idcomentario.value,
            start: form.elements.start.value,
            end: form.elements.end.value,
            data: {
                note: form.elements.note.value
            }
        });

        //                                                                COGER COMENTARIOS DEL FORM Y GUARDARLOS EN BBDD
        
        $.ajax('json_guardaComentarios.php', {
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'cancion': cancion,
                        'inicio': form.elements.start.value,
                        'fin': form.elements.end.value,
                        'comentario': form.elements.note.value,
                        'idcomentario': form.elements.idcomentario.value,
            }
        }).then(function(respuesta){
            console.log('respuesta');
        });
//        $.getJSON(localStorage.regions).then(function(respuesta){
//            console.log(respuesta);
//        })
//        ;
//        $.ajax('guardaComentarios.php', {
//            type: 'POST',
//            dataType: 'json',
//            data: {
//                'nombre': 'marcel',
//                'mensaje': 'holaa'
//            }
//        }).then(function (respuesta) {
//            console.log(respuesta);
//            $('#respuesta').prepend($(`
//                
//                    ${respuesta.nombre}
//                    ${respuesta.mensaje}
//                
//            `));
//        });
        
//                    var ajax_url = "guardaComentarios.php";
//                    var ajax_request = new XMLHttpRequest();
//                    ajax_request.open( "POST", ajax_url, true );
//                    ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//                    ajax_request.send( region );
               
        
        
        form.style.opacity = 0;
    };
    form.onreset = function() {
        form.style.opacity = 0;
        form.dataset.region = null;
    };
    form.dataset.region = region.id;
}

/**
 * Display annotation.
 */
function showNote(region) {
    if (!showNote.el) {
        showNote.el = document.querySelector('#subtitle');
    }
    showNote.el.textContent = region.data.note || '–';
}

/**
 * Bind controls.                                                                   COGER DATOS DEL FORM Y  BORRAR REGION
 */
window.GLOBAL_ACTIONS['delete-region'] = function() {
    var form = document.forms.edit;
    var regionId = form.dataset.region;
    if (regionId) {
        wavesurfer.regions.list[regionId].remove();
        form.reset();
    };
//    $.ajax('json_borraComentarios.php', {
//                    type: 'POST',
//                    dataType: 'json',
//                    data: {
//                        'cancion': cancion,
//                        'inicio': form.elements.start.value,
//                        'fin': form.elements.end.value,
//                        'comentario': form.elements.note.value,
//                        'idcomentario': form.elements.idcomentario.value,
//            }
//        }).then(function(respuesta){
//            console.log(respuesta);
//        });
};

window.GLOBAL_ACTIONS['export'] = function() {
    window.open(
        'data:application/json;charset=utf-8,' +
            encodeURIComponent(localStorage.regions)
    );
};