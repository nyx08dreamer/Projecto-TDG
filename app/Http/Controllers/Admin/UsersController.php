<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Entities\Admin\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\Controllers\ChangeImageTrait;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UsersController extends Controller implements HasMiddleware
{

    use ChangeImageTrait; 

    const PERMISSIONS = [
        'create' => 'admin-user-create',
        'show' => 'admin-user-show',
        'edit' => 'admin-user-edit',
        'delete' => 'admin-user-delete',

    ];
    
    public static function middleware(): array
    {
        return [
            // 'auth',
            // new Middleware('role_or_permission:demo|show', only: ['index']),
            new Middleware('permission:'.self::PERMISSIONS['create'], only: ['create', 'store']),
            new Middleware('permission:'.self::PERMISSIONS['show'], only: [ 'index','show']),
            new Middleware('permission:'.self::PERMISSIONS['edit'], only: ['edit', 'update']),

            
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
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

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

        $user->created_by = 1;
        $user->updated_by = 1;

        $user->save();

        return redirect()->route('admin.user.show', $user->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        return view('admin.user.show', [
            'user' => $user,
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

        //dd($request->all());

        $user->save();
        
        return redirect()->route('admin.user.show', $user->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
