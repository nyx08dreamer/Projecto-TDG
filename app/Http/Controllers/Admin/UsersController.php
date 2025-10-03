<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;
use App\Models\Entities\Admin\User;
use App\Http\Controllers\Controller;
use App\Traits\Controllers\ChangeImageTrait;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Entities\Admin\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller implements HasMiddleware
{

    use ChangeImageTrait; 

    const PERMISSIONS = [
        'create' => 'admin-user-create',
        'show' => 'admin-user-show',
        'edit' => 'admin-user-edit',
        
        'delete' => 'admin-user-delete',

        'assign-roles' => 'admin-user-role',
        'assign-permissions' => 'admin-user-permission',

    ];
    
    public static function middleware(): array
    {
        return [

            new Middleware('permission:'.self::PERMISSIONS['create'], only: ['create', 'store']),
            new Middleware('permission:'.self::PERMISSIONS['show'], only: [ 'index','show']),
            new Middleware('permission:'.self::PERMISSIONS['edit'], only: ['edit', 'update']),
            new Middleware('permission:'.self::PERMISSIONS['assign-roles'], only: ['role']),
            new Middleware('permission:'.self::PERMISSIONS['assign-permissions'], only: ['permission']),

        ];
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('admin.user.index');
    }

    public function UserList (Request $request)
    {
        

        if ($request->ajax()) {

            $user_model = new User;
            $users = $user_model->get_users();

            $datatables = DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('first_name', function($user) {
                
                $url = route('admin.user.show', $user->id);
                return '<a href="' . $url . '">' . e($user->first_name) . '</a>';
            })
            ->rawColumns(['first_name']) 
            ->make(true);

            return $datatables;
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        $status = 'success';
        $content = 'El usuario ha sido creado correctamente';

        DB::beginTransaction(); 

        try {

            $user = new User();

            $firstName = $request->input('first_name');
            $verifiedFirstName = ucwords(strtolower(trim(preg_replace('/\s+/', ' ', $firstName))));
            $user->first_name = $verifiedFirstName;

            $lastName = $request->input('last_name');
            $verifiedLastName = ucwords(strtolower(trim(preg_replace('/\s+/', ' ', $lastName))));
            $user->last_name = $verifiedLastName;

            $user->document_number = $request->input('document_number');

            $verifiedEmail = $request->input('email');
            $user->email = trim($verifiedEmail);

            $verifiedUser = $request->input('username');
            $user->username= trim($verifiedUser);

            $user->start_date = $request->input('start_date');

            $user->password = bcrypt($request->input('username'));

            $user->created_by = Auth::id();
            $user->updated_by = Auth::id();

            $user->save();

            $user->roles()->sync($request->role);
            $user->permissions()->sync($request->permission);

            DB::commit();

            return redirect()
                ->route('admin.user.show', $user->id)
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);

        } catch (\Throwable $th) {
            DB::rollBack();

            $status = 'error';
            $content = 'Ha ocurrido un error al crear el usuario';

            return redirect()
                ->route('admin.user.create')
                ->withInput()
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        return view('admin.user.show', [
            'user' => $user,
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $status = 'success';
        $content = 'La información ha sido actualizada correctamente';

        DB::beginTransaction();

        try {

            $firstName = $request->input('first_name');
            $verifiedFirstName = ucwords(strtolower(trim(preg_replace('/\s+/', ' ', $firstName))));
            $user->first_name = $verifiedFirstName;

            $lastName = $request->input('last_name');
            $verifiedLastName = ucwords(strtolower(trim(preg_replace('/\s+/', ' ', $lastName))));
            $user->last_name = $verifiedLastName;
            
            $user->document_number = $request->input('document_number');
            
            $verifiedEmail = $request->input('email');
            $user->email = trim($verifiedEmail);

            $verifiedUser = $request->input('username');
            $user->username= trim($verifiedUser);

            $user->start_date = $request->input('start_date');

            $user->updated_by = Auth::id();

            $user->save();

            DB::commit();

        } catch (\Throwable $th) {
            
            DB::rollBack();

            $status = 'error';
            $content = 'Ha ocurrido un error al actualizar la información';
        }

            return redirect()
                ->route('admin.user.show', $user->id)
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);

    }

    public function role(Request $request, User $user) 
    {

        $status = 'success';
        $content = 'Se asignaron corretamente los roles al usuario';

        DB::beginTransaction();

        try {

            $user->roles()->sync($request->role);

            DB::commit();

        } catch (\Throwable $th) {
            
            DB::rollBack();

            $status = 'error';
            $content = 'Ha ocurrido un error al asignar los roles al usuario';
        }

        return redirect()
                ->route('admin.user.show', $user->id)
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }

    
    public function permission(Request $request, User $user) 
    {
        $status = 'success';
        $content = 'Se asignaron correctamente los permisos al usuario';

        DB::beginTransaction();

        try {
            $user->permissions()->sync($request->permission);
            DB::commit();

        } catch (\Throwable $th) {
            
            DB::rollBack();

            $status = 'error';
            $content = 'Ha ocurrido un error al asignar los permisos al usuario';
        }

        return redirect()
                ->route('admin.user.show', $user->id)
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
