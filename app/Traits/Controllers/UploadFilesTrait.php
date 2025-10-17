<?php

namespace App\Traits\Controllers;

use App\Models\Entities\Admin\User;
use App\Models\Entities\Tickets\Ticket as CustomTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait UploadFilesTrait {

    public function files(Request $request, User $user, CustomTicket $ticket) {

        $image_name = $user->id . '.' . $request->file('image')->getClientOriginalExtension();

        $status = 'success';
        $content = 'Los documentos she han guardado correctamente';

        DB::beginTransaction(); 

        try {

            $user->image_path = $image_name;

            $request->file('image')->storeAs('image_profiles', $image_name, 'public');
            
            $user->save();

            DB::commit();

        } catch (\Throwable $th) {
            
            DB::rollBack();

            $status = 'error';
            $content = 'Ha ocurrido un error al cargar los documentos';
        }

        return redirect()
                ->route('admin.user.show', $user->id)
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }
}