<?php

namespace App\Http\Controllers;

// use App\Models\ESTADO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TablasController extends Controller
{

    public function index()
    {
        //
    }

    public function traer_estados()
    {
        $this->escribir_log('traer_estados');

        // rc95 08/09/2021 00:32
        // $respuesta = DB::select('select ID, NOMBRE from ESTADO;');
        // return $respuesta;
        
        //rc95 13/08/2021 20:32
        $tabla = DB::select('select ID, NOMBRE, round(RAND()*(25-10)+10) as CANTIDAD from ESTADO;');
        $titulos = collect($tabla)->pluck('NOMBRE');
        $cantidades = collect($tabla)->pluck('CANTIDAD');

        $respuesta = array(
            "tabla" => $tabla,
            "titulos" => $titulos,
            "cantidades" => $cantidades,
            "total" => $cantidades->sum(),
        );
        return $respuesta;
    }

    public function traer_roles()
    {
        $this->escribir_log('traer_roles');

        // rc95 08/09/2021 00:32
        // $respuesta = DB::select('select ID, NOMBRE from ROL;');

        //rc95 13/08/2021 21:42
        $tabla = DB::select('select ID, NOMBRE, round(RAND()*(25-10)+10) as CANTIDAD from ROL
        where FECHA_ELIMINACION is null;');
        $titulos = collect($tabla)->pluck('NOMBRE');
        $cantidades = collect($tabla)->pluck('CANTIDAD');

        $respuesta = array(
            "tabla" => $tabla,
            "titulos" => $titulos,
            "cantidades" => $cantidades,
            "total" => $cantidades->sum(),
        );
        return $respuesta;
    }

    //rc95 12/02/2022 20:28
    public function crear_rol(Request $request)
    {
        $nombre = $request['nombre'];
        $query = "insert into ROL(NOMBRE, USUARIO_GRABACION, FECHA_GRABACION) values('$nombre', 1, now());";
        $this->escribir_log('crear_rol >>> ' . $query);
        return DB::statement($query);
    }
    //rc95 12/02/2022 20:46
    public function editar_rol(Request $request)
    {
        $id_registro = $request['id_registro'];
        $nombre = $request['nombre'];
        $query = "update ROL set NOMBRE = '$nombre' where ID = '$id_registro';";
        $this->escribir_log('editar_rol >>> ' . $query);
        return DB::statement($query);
    }
    //rc95 12/02/2022 20:46
    public function eliminar_rol(Request $request)
    {
        $id_registro = $request['id_registro'];
        $query = "update ROL set FECHA_ELIMINACION = now(), USUARIO_ELIMINACION = 1 where ID = '$id_registro';";
        $this->escribir_log('eliminar_rol >>> ' . $query);
        return DB::statement($query);
    }
    
    public function traer_empresas()
    {
        $this->escribir_log('traer_empresas');

        // rc95 08/09/2021 00:32
        //$respuesta = DB::select('select ID, NOMBRE, CORREO, TELEFONO, DIRECCION from EMPRESA;');

        //rc95 13/08/2021 21:46
        $tabla = DB::select('select ID, NOMBRE, CORREO, TELEFONO, DIRECCION, round(RAND()*(25-10)+10) as CANTIDAD from EMPRESA;');
        $titulos = collect($tabla)->pluck('NOMBRE');
        $cantidades = collect($tabla)->pluck('CANTIDAD');

        $respuesta = array(
            "tabla" => $tabla,
            "titulos" => $titulos,
            "cantidades" => $cantidades,
            "total" => $cantidades->sum(),
        );
        return $respuesta;
    }


    //rc95 17/08/2021 00:22
    public function traer_tablas(Request $request)
    {
        $nombre_tabla = $request['nombre_tabla'];
        $this->escribir_log('traer_tablas >>> ' . $nombre_tabla);
        
        $tabla = DB::select('select ID, NOMBRE, round(RAND()*(25-10)+10) as CANTIDAD from ' .$nombre_tabla);
        $titulos = collect($tabla)->pluck('NOMBRE');
        $cantidades = collect($tabla)->pluck('CANTIDAD');

        $respuesta = array(
            "tabla" => $tabla,
            "titulos" => $titulos,
            "cantidades" => $cantidades,
            "total" => $cantidades->sum(),
        );
        return $respuesta;
    }

    //rc95 12/02/2022 16:51 - login artesanal..
    public function comprobar_login(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $this->escribir_log('comprobar_login >>> ' . $email);
        
        $this->escribir_log("select ID, NAME, EMAIL from users where EMAIL = '$email' and password = '$password' ;");
        $tabla = DB::select("select ID, NAME, EMAIL from users where EMAIL = '$email' and password = '$password' ;");
        $id = collect($tabla)->pluck('ID');
        $nombre = collect($tabla)->pluck('NAME');
        $correo = collect($tabla)->pluck('EMAIL');

        $respuesta = array(
            "id" => $id,
            "nombre" => $nombre,
            "correo" => $correo,
        );
        return $respuesta;
    }

    // rc95 27/06/2021 18:20 - 
    // https://stackoverflow.com/questions/24972424/create-or-write-append-in-text-file
    // https://stackoverflow.com/questions/17861412/calling-other-function-in-the-same-controller
    // /var/www/html/lady_api/public/lady_api_log.txt
    function escribir_log($txt)
    {
        $txt = date("d/m/Y H:i:s") . " >>> " . $txt;
        $myfile = file_put_contents('lady_api_log.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(ESTADO $eSTADO)
    {
        //
    }

    public function edit(ESTADO $eSTADO)
    {
        //
    }


    public function update(Request $request, ESTADO $eSTADO)
    {
        //
    }

    public function destroy(ESTADO $eSTADO)
    {
        //
    }
}
