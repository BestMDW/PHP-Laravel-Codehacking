<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users.
        $users = User::all();

        // Load view from "resources\views\admin\users\index.blade.php"
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statusFieldOptions = User::getStatusOptions();
        $roles = Role::lists('name', 'id')->all();
        // Load view from "resources\views\admin\users\create.blade.php"
        return view('admin.users.create', compact('statusFieldOptions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input = $request->all();

        // Check if photo was uploaded.
        if ($file = $request->file('photo_id')) {
            // Concatenate current time and original file nme.
            $name = time() . $file->getClientOriginalName();

            // Move uploaded file into the directory for uploads.
            $file->move(User::UPLOAD_DIRECTORY, $name);

            // Create new record in database for the photo and assign that specific row with variable.
            $photo = Photo::create(['path' => $name]);

            // Update request with added photo id.
            $input['photo_id'] = $photo->id;
        }

        // Create new user.
        User::create($input);

        // Redirect to the users list in the administrator panel.
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Load view from "resources\views\admin\users\edit.blade.php"
        return view('admin.users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
