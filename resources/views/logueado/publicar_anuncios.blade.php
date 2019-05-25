@extends('maestra_logueado')
@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
        </div>
        <div class="col-3"></div>

        <div class="col-12">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>PUBLICAR ANUNCIO</h1>
                </div>
            </div> 
            <form action="publicar_anuncio" name="formulario_anuncio" method="POST"  enctype="multipart/form-data">
                {!! csrf_field(); !!}
                <fieldset>
                    <legend>DATOS ANUNCIO</legend>
                    <div class="row">
                        <div class="col-6">
                            <label  class="col-3"  for="tipo">TIPO</label>
                            <select class="selectpicker" name="tipo" id="tipo">
                                <option>casa</option>
                                <option>piso</option>
                                <option>local</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label  class="col-3"  for="opcion">OPCION</label>
                            <select class="selectpicker" name="opcion" id="opcion">
                                <option>comprar</option>
                                <option>alquiler</option>
                                <option>compartir</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="col-3" for="provincia">PROVINCIA</label> <input class="form-control-sm col-6" name="provincia" id="provincia" required>
                        </div>
                        <div class="col-6">   
                            <label class="col-3" for="localidad">LOCALIDAD</label> <input class="form-control-sm col-6" name="localidad" id="localidad" required>
                        </div>  
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <label class="col-3" for="via">CALLE</label> <input class="form-control-sm col-6" name="via" id="via" required>
                        </div>
                        <div class="col-6">
                            <label class="col-3" for="numero">NUMERO</label> <input type="number" class="form-control-sm col-6" name="numero" id="numero" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="col-3" for="metros">M2</label> <input type="number" class="form-control-sm col-6" name="metros" id="metros" required>
                        </div>
                        <div class="col-6">
                            <label class="col-3" for="precio">PRECIO€</label> <input type="number" class="form-control-sm col-6" name="precio" id="precio" step=".01" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                            <label class="col-3" for="file">SUBIR 1 FOTOS </label><input class="col-9" type="file" name="file[]" multiple>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <textarea class="col-12" name="descripcion" id="descripcion" required placeholder="AÑADE LA DESCRIPCIÓN DEL INMUEBLE"></textarea>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>DATOS CONTACTO</legend>
                    <div class="row">
                        <div class="col-6">
                            <label class="col-3" for="email">EMAIL</label> <input class="form-control-sm col-6" name="email" id="email" value=" <?php $user = \Session::get('user');
echo $user[0]->correo;
?>  ">
                        </div>
                        <div class="col-6">
                            <label class="col-3" for="telefono">TELEFONO</label> <input class="form-control-sm col-6" name="telefono" id="telefono" type="number" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="col-3" for="contacto">CONTACTO</label>
                            <input type="radio" checked name="contacto" id="contacto" value="correo" checked>CORREO 
                            <input type="radio" name="contacto" id="contacto" value="telefono">TELEFONO 
                            <input type="radio" name="contacto" value="ambos"  id="contacto">AMBOS
                        </div>               
                    </div>
                </fieldset>


                <div class="row ">
                    <div class="col-12 text-center ">
                        <input type="submit" class="form-control-lg btn btn-lg" name="publicar" value="Publicar anuncio">
                    </div>
                </div>
            </form>
        </div>

    </div>
    @endsection