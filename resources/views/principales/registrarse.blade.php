@extends('maestra')
@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>REGISTRO</h1>
                </div>
            </div>
            <form action="registrarse" name="formulario_registro" method="POST">
                {!! csrf_field(); !!}
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="email">EMAIL</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <input class="form-control-lg" name="email" id="email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="usuario">NOMBRE DE USUARIO</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <input class="form-control-lg" name="user" id="user">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="pass">PASSWORD</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <input class="form-control-lg" name="pass" id="pass" type="password"> 
                    </div>
                </div>

                <?php if (isset($men)) {
                    ?>

                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="mensaje"> <?php echo $men ?> </p>
                        </div>
                    </div>
                <?php }
                ?>

                <div class="row ">
                    <div class="col-12 text-center ">
                        <input type="submit" class="form-control-lg btn btn-lg" name="registro" value="Registrarse">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
</div>
@endsection