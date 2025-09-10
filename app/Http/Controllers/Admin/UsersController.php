<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Entities\Admin\User;
use App\Traits\Controllers\ChangeImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{

    use ChangeImageTrait; 
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
