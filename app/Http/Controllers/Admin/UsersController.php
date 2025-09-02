<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entities\Admin\User;
use Illuminate\Http\Request;
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

    public function UserList (Request $request)
    {
        

        if ($request->ajax()) {

            $user_model = new User;
            $users = $user_model->get_users();

            $datatables = DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('first_name', function($user) {
                
                $url = route('users.show', $user->id);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
