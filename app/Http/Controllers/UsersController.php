<?php

namespace App\Http\Controllers;

use App\Models\UserFiles;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['count_user']      = Users::count();

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.modify');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email',
            'birth'         => 'required|date',
            'username'      => 'required'
        ]);
        
        $user           = new Users();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->birth    = $request->birth;
        $user->username = $request->username;
        $user->save();

        if($request->file('addfile')) {
            $file           = $request->file('addfile');
            $filename       = time().'_'.$file->getClientOriginalName();
            $filePath       = $request->file('addfile')->storeAs('uploads', $filename, 'public');

            $user_files             = new UserFiles();
            $user_files->user_id    = $user->id;
            $user_files->file       = $filename;
            $user_files->save();
        }


        return 'success';
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['user']           = Users::findOrFail($id);
        $data['user_files']     = UserFiles::where('user_id', $id)->get();

        return view('users.modify', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email',
            'birth'         => 'required|date',
            'username'      => 'required'
        ]);

        $user           = Users::findOrFail($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->birth    = $request->birth;
        $user->username = $request->username;
        $user->save();

        if($request->file('addfile')) {
            $file           = $request->file('addfile');
            $filename       = time().'_'.$file->getClientOriginalName();
            $filePath       = $request->file('addfile')->storeAs('uploads', $filename, 'public');

            $user_files             = new UserFiles();
            $user_files->user_id    = $user->id;
            $user_files->file       = $filename;
            $user_files->save();
        }

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user           = Users::findOrFail($id);
        $user->delete();

        return 'success';
    }

    public function getTable(){
        $data['users']      = Users::paginate(10);
        return view('users.tables', $data);
    }
}
