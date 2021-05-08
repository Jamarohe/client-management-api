<?php 

namespace App\Classes;

use DB;
use App\Models\RoleMenu;
use App\Models\RolUser; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class FormatResponse extends Controller{
    /**
	 * Formato de respuesta con Json
	 * @param $status
	 * @param $data
	 *
	 * @return Json
	 */
	public function toJson($status, $data = null)
	{
        /*
		|---------------------------------------------------------------------------------------
		| Definir salida de respuesta
		|---------------------------------------------------------------------------------------
		*/
		$response = [
			'status' => $status
        ];
        
		if($data !== null){
        	$response['data'] = $data;
        	
        }
        
        /*
        |---------------------------------------------------------------------------------------
		| Transformar la respuesta a json
		|---------------------------------------------------------------------------------------
		*/
        // $response = Response::json($response);
        
        /*
		|---------------------------------------------------------------------------------------
		| Retornar respuesta
		|---------------------------------------------------------------------------------------
        */
        return $response;
	}

	/**
	 * Formato de respuesta con Json
	 * @param $status
	 * @param $data
	 *
	 * @return Json
	 */
	public function SQLjsontoJson($data)
	{
        /*
		|---------------------------------------------------------------------------------------
		| Definir salida de respuesta
		|---------------------------------------------------------------------------------------
		*/
		 $archivoJson ="";
		 if(count($data)>1){
			for ($i=0; $i < count($data); $i++) { 
				foreach ($data[$i] as $key => $obj) {
					$archivoJson = $archivoJson.$obj;
				   }
			}
		 }else{
		  foreach ($data as $key => $value) {
			 foreach ($value as $key => $obj) {
		    	$archivoJson = $obj;
			}
		  }
		}
		 $archivoJson = json_decode($archivoJson);
		
        /*
        |---------------------------------------------------------------------------------------
		| Transformar la respuesta a json
		|---------------------------------------------------------------------------------------
		*/
        // $response = Response::json($response);
        
        /*
		|---------------------------------------------------------------------------------------
		| Retornar respuesta
		|---------------------------------------------------------------------------------------
        */
        return $archivoJson;
	}

	/*
	|---------------------------------------------------------------------------------------
	|**********
	|**********
	| 			Dato repetido
	|**********
	|**********
	|---------------------------------------------------------------------------------------
    */
    
    /**
	 * Retorna el estado cuando una solicitud es
	 * exitosa
	 *
	 * @return Array
	 */
	public function datoRepetido()
	{
		return [
			'code' => 401,
			'message' => "El valor ingresado ya existe"
		];
    }
	
	/*
	|---------------------------------------------------------------------------------------
	|**********
	|**********
	| 			Acceso exitodenegadoso
	|**********
	|**********
	|---------------------------------------------------------------------------------------
    */
    
    /**
	 * Retorna el estado cuando una solicitud es
	 * exitosa
	 *
	 * @return Array
	 */
	public function accesosDenegado()
	{
		return [
			'code' => 403,
			'message' => "Accesos denegado"
		];
    }

    /*
	|---------------------------------------------------------------------------------------
	|**********
	|**********
	| 			Estado exitoso
	|**********
	|**********
	|---------------------------------------------------------------------------------------
    */
    
    /**
	 * Retorna el estado cuando una solicitud es
	 * exitosa
	 *
	 * @return Array
	 */
	public function estadoExitoso($msj = null)
	{
		$mensaje = $msj == null ? "Procesado con éxito" : $msj;
		return [
			'code' => 1,
			'message' => $mensaje
		];
    }
    
    /*
	|---------------------------------------------------------------------------------------
	|**********
	|**********
	| 			Estado errores
	|**********
	|**********
	|---------------------------------------------------------------------------------------
    */
    
    /**
	 * Estado de retorno cuando el resultado es
	 * no encontrado
	 *
	 * @return Array
	 */
	public function estadoNoEncontrado($msj = null)
	{
		$mensaje = $msj == null ? "Resultado no encontrado" : $msj;
		return [
			'code' => 0,
			'message' => $mensaje
		];
	}
	

    
    /**
	 * Estado de retorno cuando la operación
	 * ha fallado
	 *
	 * @return Array
	 */
	public function estadoOperacionFallida($msj = null)
	{
		$mensaje = $msj == null ? "Error: Operación fallida" : $msj;
		return [
			'code' => -1,
			'message' => $mensaje
		];
    }
    
    /**
	 * Estado de retorno cuando los parámetros
	 * son incorrectos
	 *
	 * @return Array
	 */
	public function estadoParametrosIncorrectos()
	{
		return [
			'code' => -2,
			'message' => 'Parametros incorrectos'
		];
    }

    /**
	 * Estado de retorno cuando la solicitud
	 * no se ha detectado
	 *
	 * @return Array
	 */
	public function estadoSolicitudNoDetectada()
	{
		return [
			'code' => -200,
			'message' => "NO SE DETECTA LA SOLICITUD"
		];
	}

	/**
	 * Estado de retorno cuando la petición
	 * no es autorizada
	 *
	 * @return Array
	 */
	public function estadoNoAutorizado($msj = null)
	{
		$mensaje = $msj == null ? "No autorizado" : $msj;
		return [
			'code' => 401,
			'message' => $mensaje
		];
	}

	/**
	 * Estado de retorno cuando el token
	 * ha expirado
	 *
	 * @return Array
	 */
	public function tokenExpiro()
	{
		return [
			'code' => 400,
			'message' => "El token expiró"
		];
	}

	/**
	 * Estado de retorno cuando el token
	 * es invalido
	 *
	 * @return Array
	 */
	public function tokenInvalido()
	{
		return [
			'code' => 400,
			'message' => "El token es invalido"
		];
	}

	/**
	 * Estado de retorno cuando el token
	 * es ausente
	 *
	 * @return Array
	 */
	public function tokenAusente()
	{
		return [
			'code' => 400,
			'message' => "Token ausente"
		];
	}
}