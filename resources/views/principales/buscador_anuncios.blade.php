@extends('maestra')
@section('content')
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css"> -->


<div class="col-12">
    <?php if (isset($anuncios)) {
        ?>   
        <h1 class="text-center">ENCUENTRA TU SITIO DONDE VAS A VIVIR</h1>
        <form name="formulario_busqueda" action="buscar" method="POST">
            {!! csrf_field(); !!}
            <div class="text-center">
                <input type="search" class="form-control-lg"  name="dato" id="dato" placeholder="población, provincia">
                <input type="submit" class="form-control-lg btn btn-lg boton" name="buscar" value="Buscar">
            </div>
        </form>
        <?php foreach ($anuncios as $a) {
            ?>
            <form action="mi_anuncio" name="formulario_anuncio" method="POST">
                {!! csrf_field(); !!}
                <fieldset class="bloques_anuncios">
                    <div class="row">
                        <div class="col-4">
                            <div id="myCarousel<?php echo $a->id; ?>" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <?php
                                    if ($a->c_fotos !== 0) {
                                        for ($index = 0; $index < $a->c_fotos; $index++) {
                                            ?>
                                            <div class="item  <?php
                                            if ($index === 0) {
                                                echo 'active';
                                            }
                                            ?> ">
                                                <img src="img/<?php echo $a->correo . '-' . strval($a->id) . '-' . $index; ?>" class="img_carru">
                                            </div>
                                        <?php }
                                    } else {
                                        ?>
                                        <div class="item">
                                            <img src="img/<?php echo "default.png"; ?>" class="img_carru">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel<?php echo $a->id; ?>" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel<?php echo $a->id; ?>" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-6"> 
                                    <div class="row">
                                        <label for="localidad">LUGAR: </label><?php echo $a->localidad . ',' . $a->provincia; ?>
                                    </div>  </div>
                                <div class="col-3">  

                                    <label for="precio">TIPO: </label><?php echo $a->tipo; ?>
                                </div>     
                                <div class="col-3">  
                                    <div class="row">
                                        <label for="precio">PRECIO€: </label><?php echo $a->precio; ?>
                                    </div></div>

                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <label for="via">VIA: </label><?php echo $a->calle; ?>
                                    </div> </div>

                                <div class="col-3">
                                    <div class="row">
                                        <label class="col-5"  for="numero">NUMERO: </label> <?php echo strval($a->numero); ?>
                                    </div></div>
                                <div class="col-3">
                                    <div class="row">
                                        <label for="metros">M2: </label><?php echo strval($a->metros); ?>
                                    </div></div>

                            </div>

                            <div class="row mitextarea">
                                <textarea class="col-10 " name="descripcion" id="descripcion"><?php echo $a->descripcion; ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <label for="contacto">CONTACTO:</label><?php
                                        if ($a->contacto === 1) {
                                            echo $a->correo;
                                        } else if ($a->contacto === 2) {
                                            echo strval($a->telefono);
                                        } else {
                                            echo $a->correo . ', (tlf)' . strval($a->telefono);
                                        }
                                        ?>
                                    </div></div>
                            </div>
                        </div>
                    </div>
                    <input  name="id" id="id" value=" <?php echo $a->id; ?>" hidden="">
                </fieldset>
            </form>

            <?php
        }
    }
    ?>
    <?php if (isset($men)) {
        ?>

        <div class="row">
            <div class="col-12 text-center">
                <p class="mensaje mensaje_centrar"> <?php echo $men ?> </p>
            </div>
        </div>
    <?php }
    ?>
</div>
@endsection