<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function cargar_archivo_temporal(Request $request)
    {
        if ($request->hasFile('archivos')) {
    
            $archivo = $request->file('archivos');
    
            try {
                    $extension = $archivo->getClientOriginalExtension();
                } catch (\Exception $e) {
                    $extension = 'txt';
                }
                $nombre_archivo = 'documento_' . time() . '_' . time() . '.' . $extension;
                $ruta_archivo = 'public/temp/' . $nombre_archivo;
    
                if (Storage::exists($ruta_archivo)) {
                    abort(422, 'El archivo ya existe.');
                } else {
                    $archivo->storeAs('public/temp/', $nombre_archivo);
                    return $nombre_archivo;
                }
        }
        
        return abort(500, 'Error en la carga');
    }

    public function eliminar_archivo_temporal(Request $request)
    {
        $archivo_temporal = $request->getContent();

        if ($archivo_temporal) {

            Storage::delete('public/temp/' . $archivo_temporal);
        
            return $archivo_temporal;
        }

        return false;
    } 

    
}
