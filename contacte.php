
<html id="contacte">
    <head>
        <title>Contacte</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link  rel="shortcut icon"  href="img/favicon.ico">
        <link  href="http://binarysunsetestudio.com/img/iconomicro.jpg"  rel="image_src">
        <meta  property="og:image"  content="http://binarysunsetestudio.com/img/iconomicro.jpg">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/estilo.css">

    </head>
    <body>
        <div class="container">
            <div class="row ">
                <div class="col-6 d-flex flex-wrap aligh-content-end" id="menu"></div>
                <div class="col-6   ">
                     <img class="img-fluid float-right mt-2 mb-2 mr-2" src="img/logo2.png" alt="Logo Binary Sunset">
                </div>
 
            </div>
            
            <div class="row">
                <div class="col-12 ">
                    <img class="img-fluid" src="img/co_banner.png" alt="banner contacte">
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12 col-md-6 mt-5 d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <p class="mb-4">Tel: 625941002</p>
                        <p class="mb-4">marcel@binarysunsetestudio.com</p>
                        <a class="mr-3" href="https://www.facebook.com/BinarySunsetEstudio/" target="blank"><img src="img/facebook.png"></a> 
                        <a class="ml-3" href="https://www.instagram.com/binary_sunset_estudio/" target="blank"><img src="img/instagram.png"></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 mt-5">
                    <div>
                    
                    </div>
                    <span class="naranja" id="respuesta"></span>
                    <form  method="post"  >
                        <div class="form-group">
                            <label for="idnombre">Nombre<span class="rojo">*</span><span id="error_nombre"></span></label>
                            <input type="text" class="form-control form-control-sm" id="idnombre" name="nombre" data-rule="required" data-msg=" Escribe tu nombre">
                        </div>
                        <div class="form-group">
                            <label for="idemail">Email<span class="rojo">*</span><span id="error_email"></span></label>
                            <input type="text" class="form-control form-control-sm" id="idemail" name="email" data-rule="email" data-msg=' Escribe un email válido'>
                        </div>
                        <div class="form-group">
                            <label for="idcomentario">Comentario<span class="rojo">*</span><span id="error_comentario"></label>
                            <textarea  class="form-control form-control-sm" id="idcomentario" rows="4" maxlength="500" name="comentario" data-rule="required" data-msg="Escribe un comentario"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="idboton"></label>
                            <input type="submit" class="form-control form-control-sm bgnaranja colortextos w-25" id="idboton" name="submit">
                        </div>
                        
                        
                        
                    </form>
                </div>
            </div>
        </div>
        
        
        
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="js/agregamenu.js"></script>
        <script src="js/contacte.js"></script>
    </body>
</html>
