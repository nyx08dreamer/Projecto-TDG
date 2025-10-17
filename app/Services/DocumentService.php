<?php

namespace App\Services;

use App\Models\Dual;
use App\Models\Entities\Tickets\Document;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class DocumentService 
{

    public static function copiar($from_path, $to_path)
    {
        $disk = Storage::disk('public'); 
        if (!$disk->exists($from_path)) {
            throw new \Exception('El archivo de origen no existe: ' . $from_path);
        }
        $contenido = $disk->get($from_path);
        
        if ($contenido === null) {
            throw new \Exception('No se pudo obtener el contenido del archivo: ' . $from_path);
        }
        $disk->put($to_path, $contenido);
        if (!$disk->exists($to_path)) {
            throw new \Exception('El archivo no se guardó, intente de nuevo');
        }
        return;
    }

    public static function guardar(array $data)
    {
        $documento = Document::create($data);

        return $documento;
    }

    public static function eliminar($from_path)
    {
        $disk = Storage::disk('public'); 
        $intentos = 1; 
        $eliminado = false;
        for ($i = 0; $i < $intentos; $i++) {
            if ($disk->exists($from_path)) {
                $eliminado = $disk->delete($from_path);
            }
            if ($eliminado) {
                break;
            }
            sleep(1); 
        }

        return;
    }

    public static function obtenerDocumentosPorSolicitudId($id_solicitud)
    {   
            $documento_model = new Document;
            $documentos = $documento_model->GetDocumentoPorId($id_solicitud);

            return $documentos->filter(function ($documento) {
            return Storage::exists($documento->ruta);
        })->map(function ($documento) {
            // Agregar metadatos útiles
            $documento->extension = pathinfo($documento->nombre_documento, PATHINFO_EXTENSION);
            $documento->url_descarga = asset($documento->ruta);
            return $documento;
        });
    }
}