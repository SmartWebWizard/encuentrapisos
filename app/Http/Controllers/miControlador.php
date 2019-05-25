<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class miControlador extends Controller {

    function login_entrar(request $req) {
        //si viene del boton acceder entrara en el sistema
        if ($_POST['login'] == 'acceder') {
            $user = \DB::select('select * from usuarios where correo = ? and pass = ?', [$req->user, $req->pass]);
            if (empty($user)) {
                //si el usuario no está , ahora mismo no entra

                $mensaje = '*Datos introducidos incorrectos*';
                $datos = [
                    'men' => $mensaje
                ];
                return view('principales/login', $datos);
            } else {
                \Session::put('user', $user);
                $anuncios = \DB::select('SELECT * from anuncios');

                if (empty($anuncios)) {
                    $mensaje = 'NO HAY ANUNCIOS';
                    $datos = [
                        'men' => $mensaje
                    ];
                    return view('logueado/buscador_anuncios', $datos);
                } else {

                    $datos = [
                        'anuncios' => $anuncios
                    ];
                    return view('logueado/buscador_anuncios', $datos);
                }
            }
        }
    }

    function registrar_usuario(request $req) {
        $user = \DB::select('select * from usuarios where correo = ?', [$req->email]);
        if (empty($user)) {
            //Procederemos a registrar al usuario
            $email = $req->email;
            $name_user = $req->user;
            $pass = $req->pass;
            \DB::insert('insert into usuarios (correo, nombre, pass) values (?, ?, ?)', [$email, $name_user, $pass]);
            \DB::insert('insert into roles_asignados (id_rol, correo) values (?, ?)', ['2', $email]);

            return view('principales/login');
        } else {
            $mensaje = '*El email ya se encuentra en nuestro sistema*';
            $datos = [
                'men' => $mensaje
            ];
            return view('principales/registrarse', $datos);
        }
    }

    function ir_publicar_anuncio() {
        $mensaje = '*Inicia sesión para poder publicar un anuncio*';
        $datos = [
            'men' => $mensaje
        ];
        return view('principales/login', $datos);
    }

    function mis_anuncios() {
        $user = \Session::get('user');
        $anuncios = \DB::select('SELECT * from anuncios where anuncios.correo = ?', [$user[0]->correo]);
        if (empty($anuncios)) {
            $mensaje = 'NO TIENES ANUNCIOS TODAVÍA';
            $datos = [
                'men' => $mensaje
            ];
            return view('logueado/mis_anuncios', $datos);
        } else {

            $datos = [
                'anuncios' => $anuncios
            ];
            return view('logueado/mis_anuncios', $datos);
        }
    }

    function buscador_anuncios() {
        $user = \Session::get('user');
        $anuncios = \DB::select('SELECT * from anuncios');
        if (empty($user)) {
            if (empty($anuncios)) {
                $mensaje = 'NO HAY ANUNCIOS';
                $datos = [
                    'men' => $mensaje
                ];
                return view('principales/buscador_anuncios', $datos);
            } else {

                $datos = [
                    'anuncios' => $anuncios
                ];
                return view('principales/buscador_anuncios', $datos);
            }
        } else {
            if (empty($anuncios)) {
                $mensaje = 'NO HAY ANUNCIOS';
                $datos = [
                    'men' => $mensaje
                ];
                return view('logueado/buscador_anuncios', $datos);
            } else {

                $datos = [
                    'anuncios' => $anuncios
                ];
                return view('logueado/buscador_anuncios', $datos);
            }
        }
    }

    function publicar_anuncio(request $req) {
        $tipo_i = $req->tipo;
        $opcion = $req->opcion;
        $provincia = $req->provincia;
        $localidad = $req->localidad;
        $via = $req->via;
        $numero = $req->numero;
        $metros = $req->metros;
        $precio = $req->precio;
        $descripcion = $req->descripcion;
        $correo = $req->email;
        $telefono = $req->telefono;
        $contacto_forma = $req->contacto;
        if ($contacto_forma === 'correo') {
            $contacto = 1;
        } else if ($contacto_forma === 'telefono') {
            $contacto = 2;
        } else {
            $contacto = 3;
        }

        $id = '';
        $id_dato = \DB::select('SELECT MAX(id) as id FROM anuncios');
        $id = strval($id_dato[0]->id + 1);
        $cont = strval(0);
        if (isset($_FILES["file"])) {
            if ($_FILES["file"]["name"][0] !== "") {
//            for ($x = 0; $x < count($_FILES["file"]["name"]); $x++) {
                $file = $_FILES["file"];
                $nombre = $correo . '-' . $id . '-' . $cont[$cont];
                $tipo = $file["type"][$cont];
                $ruta_provisional = $file["tmp_name"][$cont];
                $carpeta = "/var/www/html/laravel/encuentrapisos/public/img/";
                $src = $carpeta . $nombre;
                move_uploaded_file($ruta_provisional, $src);
                  $cont++;
//                }
            }
        }
      
        \DB::insert('insert into anuncios (tipo, opcion, provincia, localidad, calle, numero, metros, precio, descripcion, c_fotos, correo, telefono, contacto) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$tipo_i, $opcion, $provincia, $localidad, $via, $numero, $metros, $precio, $descripcion, $cont, $correo, $telefono, $contacto]);


        $anuncios = \DB::select('SELECT * from anuncios where anuncios.correo = ?', [$correo]);
        $datos = [
            'anuncios' => $anuncios
        ];
        return view('logueado/mis_anuncios', $datos);
    }

    function eliminar_anuncio(request $req) {
        \DB::table('anuncios')->where('id', '=', $req->id)->delete();
        $user = \Session::get('user');
        $anuncios = \DB::select('SELECT * from anuncios where anuncios.correo = ?', [$user[0]->correo]);
        if (empty($anuncios)) {
            $mensaje = 'NO TIENES ANUNCIOS TODAVÍA';
            $datos = [
                'men' => $mensaje
            ];
            return view('logueado/mis_anuncios', $datos);
        } else {

            $datos = [
                'anuncios' => $anuncios
            ];
            return view('logueado/mis_anuncios', $datos);
        }
    }

    function cerrar_sesion() {
        \Session::forget('user');
        $anuncios = \DB::select('SELECT * from anuncios');
        if (empty($anuncios)) {
            $mensaje = 'NO HAY ANUNCIOS';
            $datos = [
                'men' => $mensaje
            ];
            return view('principales/buscador_anuncios', $datos);
        } else {

            $datos = [
                'anuncios' => $anuncios
            ];
            return view('principales/buscador_anuncios', $datos);
        }
    }

    function buscar_anuncios(request $req) {
        $dato = $req->dato;
        $user = \Session::get('user');
        $anuncios = \DB::select('SELECT * from anuncios where anuncios.provincia= ? or anuncios.localidad = ?', [$dato, $dato]);
        if (empty($user)) {
            if (empty($anuncios)) {
                $mensaje = 'NO HAY ANUNCIOS';
                $datos = [
                    'men' => $mensaje
                ];
                return view('principales/buscador_anuncios', $datos);
            } else {

                $datos = [
                    'anuncios' => $anuncios
                ];
                return view('principales/buscador_anuncios', $datos);
            }
        } else {
            if (empty($anuncios)) {
                $mensaje = 'NO HAY ANUNCIOS';
                $datos = [
                    'men' => $mensaje
                ];
                return view('logueado/buscador_anuncios', $datos);
            } else {

                $datos = [
                    'anuncios' => $anuncios
                ];
                return view('logueado/buscador_anuncios', $datos);
            }
        }
    }

}
