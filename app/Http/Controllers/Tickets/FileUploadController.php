<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;


class FileUploadController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function cargar_archivo_temporal(Request $request)
    {
        if ($request->hasFile('archivos')) {

            $archivos = $request->file('archivos');

            foreach ($archivos as $archivo) {
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
                    $archivo->storeAs('temp', $nombre_archivo, 'public');
                    return $nombre_archivo;
                }
                
            }
    
            
        }
        
        return abort(500, 'Error en la carga');
    }

    public function eliminar_archivo_temporal(Request $request)
    {
    
        $archivo_temporal = $request->getContent(); 
    
        if (!$archivo_temporal) {
            return false; 
        }

        $ruta_archivo = 'temp/' . $archivo_temporal;

        if (Storage::disk('public')->exists($ruta_archivo)) {
            // Borra el archivo
            Storage::disk('public')->delete($ruta_archivo);
            return $archivo_temporal; 
        }

        return false;
    } 
}
