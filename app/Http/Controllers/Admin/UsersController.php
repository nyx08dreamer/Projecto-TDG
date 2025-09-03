<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entities\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index');
    }

    public function prueba()
    {
        return view('admin.user.prueba');
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
    public function store(Request $request)
    {

        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:70',
            'last_name' => 'string|max:70',
            'document_number' => 'required|integer|unique:users,document_number',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:30|unique:users,username',
        ] , [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.string' => 'El nombre debe ser un texto.',
            'first_name.max' => 'El nombre no puede tener más de 70 caracteres.',

            'last_name.string' => 'El apellido debe ser un texto.',
            'last_name.max' => 'El apellido no puede tener más de 70 caracteres.',

            'document_number.required' => 'El documento de identidad es obligatorio.',
            'document_number.integer' => 'El documento de identidad debe contener solo números.',
            'document_number.unique' => 'El documento de identidad ya está registrado.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico es inválido.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            'username.required' => 'El usuario es obligatorio.',
            'username.string' => 'El usuario debe ser un texto.',
            'username.max' => 'El usuario no puede tener más de 30 caracteres.',
            'username.unique' => 'El usuario ya está registrado.',

        ] );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $user = new User();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->document_number = $request->input('document_number');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
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
    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:70',
            'last_name' => 'string|max:70',
            'document_number' => 'required|integer|unique:users,document_number,'.$user->id.',id',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'username' => 'required|string|max:30|unique:users,username,'.$user->id.',id',
        ] , [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.string' => 'El nombre debe ser un texto.',
            'first_name.max' => 'El nombre no puede tener más de 70 caracteres.',

            'last_name.string' => 'El apellido debe ser un texto.',
            'last_name.max' => 'El apellido no puede tener más de 70 caracteres.',

            'document_number.required' => 'El documento de identidad es obligatorio.',
            'document_number.integer' => 'El documento de identidad debe contener solo números.',
            'document_number.unique' => 'El documento de identidad ya está registrado.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico es inválido.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            'username.required' => 'El usuario es obligatorio.',
            'usernames.tring' => 'El usuario debe ser un texto.',
            'username.max' => 'El usuario no puede tener más de 30 caracteres.',
            'username.unique' => 'El usuario ya está registrado.',

        ] );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->document_number = $request->input('document_number');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
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
