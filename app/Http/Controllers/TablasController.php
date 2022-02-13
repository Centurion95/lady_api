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

    

    public function traer_roles()
    {
        $this->escribir_log('traer_roles');

        $tabla = DB::select("call sp_reporte_roles;");
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
        $query = "call sp_insertar_rol ('$nombre');";
        $this->escribir_log('crear_rol >>> ' . $query);
        return DB::statement($query);
    }
    
    public function editar_rol(Request $request)
    {
        $id_registro = $request['id_registro'];
        $nombre = $request['nombre'];
        $query = "call sp_modificar_rol ('$id_registro', '$nombre');";
        $this->escribir_log('editar_rol >>> ' . $query);
        return DB::statement($query);
    }
    
    public function eliminar_rol(Request $request)
    {
        $id_registro = $request['id_registro'];
         $query = "call sp_eliminar_rol ('$id_registro');";
        $this->escribir_log('eliminar_rol >>> ' . $query);
        return DB::statement($query);
    }
    
    public function traer_estados()
    {
        $this->escribir_log('traer_estados');

        $tabla = DB::select("call sp_reporte_estados;");
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

    //rc95 13/02/2022 10:53
    public function crear_estado(Request $request)
    {
        $nombre = $request['nombre'];
        $query = "call sp_insertar_estado ('$nombre');";
        $this->escribir_log('crear_estado >>> ' . $query);
        return DB::statement($query);
    }
    
    public function editar_estado(Request $request)
    {
        $id_registro = $request['id_registro'];
        $nombre = $request['nombre'];
        $query = "call sp_modificar_estado ('$id_registro', '$nombre');";
        $this->escribir_log('editar_estado >>> ' . $query);
        return DB::statement($query);
    }
    
    public function eliminar_estado(Request $request)
    {
        $id_registro = $request['id_registro'];
        $query = "call sp_eliminar_estado ('$id_registro');";
        $this->escribir_log('eliminar_estado >>> ' . $query);
        return DB::statement($query);
    }

    public function traer_empresas()
    {
        $this->escribir_log('traer_empresas');

        //rc95 13/08/2021 21:46
        $tabla = DB::select("call sp_reporte_empresas");
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

    //rc95 13/02/2022 10:53
    public function crear_empresa(Request $request)
    {
        $nombre = $request['nombre'];
        $correo = $request['correo'];
        $telefono = $request['telefono'];
        $direccion = $request['direccion'];
        $query = "call sp_insertar_empresa ('$nombre', '$correo', '$telefono', '$direccion');";
        $this->escribir_log('crear_empresa >>> ' . $query);
        return DB::statement($query);
    }
    
    public function editar_empresa(Request $request)
    {
        $id_registro = $request['id_registro'];
        $nombre = $request['nombre'];
        $correo = $request['correo'];
        $telefono = $request['telefono'];
        $direccion = $request['direccion'];
        $query = "call sp_modificar_empresa ('$id_registro', '$nombre', '$correo', '$telefono', '$direccion');";
        $this->escribir_log('editar_empresa >>> ' . $query);
        return DB::statement($query);
    }
    
    public function eliminar_empresa(Request $request)
    {
        $id_registro = $request['id_registro'];
        $query = "call sp_eliminar_empresa ('$id_registro');";
        $this->escribir_log('eliminar_empresa >>> ' . $query);
        return DB::statement($query);
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

    //rc95 13/02/2022 11:22
    public function traer_tipo_documentos()
    {
        $this->escribir_log('traer_tipo_documentos');

        $tabla = DB::select("call sp_reporte_tipo_documento");
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

    public function crear_tipo_documento(Request $request)
    {
        $nombre = $request['nombre'];
        $query = "call sp_insertar_tipo_documento ('$nombre');";
        $this->escribir_log('crear_tipo_documento >>> ' . $query);
        return DB::statement($query);
    }
    
    public function editar_tipo_documento(Request $request)
    {
        $id_registro = $request['id_registro'];
        $nombre = $request['nombre'];
        $query = "call sp_modificar_tipo_documento ('$id_registro', '$nombre');";
        $this->escribir_log('editar_tipo_documento >>> ' . $query);
        return DB::statement($query);
    }
    
    public function eliminar_tipo_documento(Request $request)
    {
        $id_registro = $request['id_registro'];
        $query = "call sp_eliminar_tipo_documento ('$id_registro');";
        $this->escribir_log('eliminar_tipo_documento >>> ' . $query);
        return DB::statement($query);
    }



    //rc95 13/02/2022 11:34
    public function traer_tipo_tickets()
    {
        $this->escribir_log('traer_tipo_tickets');

        $tabla = DB::select("call sp_reporte_tipo_ticket");
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

    public function crear_tipo_ticket(Request $request)
    {
        $nombre = $request['nombre'];
        $query = "call sp_insertar_tipo_ticket ('$nombre', 1);";
        $this->escribir_log('crear_tipo_ticket >>> ' . $query);
        return DB::statement($query);
    }
    
    public function editar_tipo_ticket(Request $request)
    {
        $id_registro = $request['id_registro'];
        $nombre = $request['nombre'];
        $query = "call sp_modificar_tipo_ticket ('$id_registro', '$nombre');";
        $this->escribir_log('editar_tipo_ticket >>> ' . $query);
        return DB::statement($query);
    }
    
    public function eliminar_tipo_ticket(Request $request)
    {
        $id_registro = $request['id_registro'];
        $query = "call sp_eliminar_tipo_ticket ('$id_registro');";
        $this->escribir_log('eliminar_tipo_ticket >>> ' . $query);
        return DB::statement($query);
    }


    //rc95 13/02/2022 12:00
    public function traer_proveedores()
    {
        $this->escribir_log('traer_proveedores');

        $tabla = DB::select("call sp_reporte_proveedores");
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

    public function crear_proveedor(Request $request)
    {
        $nombre = $request['nombre'];
        $correo = $request['correo'];
        $telefono = $request['telefono'];
        $direccion = $request['direccion'];
        $query = "call sp_insertar_proveedor (1, 1, '$nombre', '$correo', '$telefono', '$direccion');";
        $this->escribir_log('crear_proveedor >>> ' . $query);
        return DB::statement($query);
    }
    
    public function editar_proveedor(Request $request)
    {
        $id_registro = $request['id_registro'];
        $nombre = $request['nombre'];
        $correo = $request['correo'];
        $telefono = $request['telefono'];
        $direccion = $request['direccion'];
        $query = "call sp_modificar_proveedor ('$id_registro', '$nombre', '$correo', '$telefono', '$direccion');";
        $this->escribir_log('editar_proveedor >>> ' . $query);
        return DB::statement($query);
    }
    
    public function eliminar_proveedor(Request $request)
    {
        $id_registro = $request['id_registro'];
        $query = "call sp_eliminar_proveedor ('$id_registro');";
        $this->escribir_log('eliminar_proveedor >>> ' . $query);
        return DB::statement($query);
    }



    //rc95 13/02/2022 13:47
    public function traer_personas()
    {
        $this->escribir_log('traer_personas');

        $tabla = DB::select("call sp_reporte_personas");
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

    public function crear_persona(Request $request)
    {
        $nombre = $request['nombre'];
        $correo = $request['correo'];
        $telefono = $request['telefono'];
        $direccion = $request['direccion'];
        $query = "call sp_insertar_persona (1, 1, '$nombre', '$correo', '$telefono', '$direccion');";
        $this->escribir_log('crear_persona >>> ' . $query);
        return DB::statement($query);
    }
    
    public function editar_persona(Request $request)
    {
        $id_registro = $request['id_registro'];
        $nombre = $request['nombre'];
        $correo = $request['correo'];
        $telefono = $request['telefono'];
        $direccion = $request['direccion'];
        $query = "call sp_modificar_persona ('$id_registro', '$nombre', '$correo', '$telefono', '$direccion');";
        $this->escribir_log('editar_persona >>> ' . $query);
        return DB::statement($query);
    }
    
    public function eliminar_persona(Request $request)
    {
        $id_registro = $request['id_registro'];
        $query = "call sp_eliminar_persona ('$id_registro');";
        $this->escribir_log('eliminar_persona >>> ' . $query);
        return DB::statement($query);
    }


    public function traer_usuarios()
    {
        $this->escribir_log('traer_usuarios');

        $tabla = DB::select("call sp_reporte_usuarios");
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

    public function crear_usuario(Request $request)
    {
        $nombre = $request['nombre'];
        $correo = $request['correo'];
        $telefono = $request['telefono'];
        $direccion = $request['direccion'];
        $query = "call sp_insertar_usuario (1, 1, '$nombre', '$correo', '$telefono', '$direccion');";
        $this->escribir_log('crear_usuario >>> ' . $query);
        return DB::statement($query);
    }
    
    public function editar_usuario(Request $request)
    {
        $id_registro = $request['id_registro'];
        $nombre = $request['nombre'];
        $correo = $request['correo'];
        $telefono = $request['telefono'];
        $direccion = $request['direccion'];
        $query = "call sp_modificar_usuario ('$id_registro', '$nombre', '$correo', '$telefono', '$direccion');";
        $this->escribir_log('editar_usuario >>> ' . $query);
        return DB::statement($query);
    }
    
    public function eliminar_usuario(Request $request)
    {
        $id_registro = $request['id_registro'];
        $query = "call sp_eliminar_usuario ('$id_registro');";
        $this->escribir_log('eliminar_usuario >>> ' . $query);
        return DB::statement($query);
    }
}
