<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Session;

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
        $users = User::paginate(15);
        // Get placeholder path.
        $placeholder = Photo::PLACEHOLDER;

        // Load view from "resources\views\admin\users\index.blade.php"
        return view('admin.users.index', compact('users', 'placeholder'));
    }

    /******************************************************************************************************************/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Load available status options for the user.
        $statusFieldOptions = User::getStatusOptions();
        // Load available roles which user can have.
        $roles = Role::pluck('name', 'id')->all();
        // Load view from "resources\views\admin\users\create.blade.php"
        return view('admin.users.create', compact('statusFieldOptions', 'roles'));
    }

    /******************************************************************************************************************/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        // Get all data from the post.
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        // Check if photo was uploaded.
        if ($file = $request->file('photo_id')) {
            // Concatenate current time and original file nme.
            $name = time() . $file->getClientOriginalName();

            // Move uploaded file into the directory for uploads.
            $file->move(Photo::UPLOAD_DIRECTORY, $name);

            // Create new record in database for the photo and assign that specific row with variable.
            $photo = Photo::create(['path' => $name]);

            // Update request with added photo id.
            $input['photo_id'] = $photo->id;
        }

        // Create new user.
        User::create($input);

        // Save message for show on the users list page.
        Session::flash('toastMessage', 'User ' . $input['name'] . ' has been added.');

        // Redirect to the users list in the administrator panel.
        return redirect()->route('admin.users.index');
    }

    /******************************************************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find and get user with specific $id.
        $user = User::findOrFail($id);
        // Load available status options for the user.
        $statusFieldOptions = User::getStatusOptions();
        // Load available roles which user can have.
        $roles = Role::pluck('name', 'id')->all();
        // Placeholder file name.
        $placeholder = Photo::PLACEHOLDER;

        // Load view from "resources\views\admin\users\edit.blade.php"
        return view('admin.users.edit', compact('user', 'statusFieldOptions', 'roles', 'placeholder'));
    }

    /******************************************************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        // Find and get user with specific id.
        $user = User::findOrFail($id);

        // Remove whitespaces and check is new password is provided.
        if (trim($request->password) == '') {
            // New password IS NOT provided, get everything from post except password field.
            $input = $request->except('password');
        } else {
            // New password is provided, get everything from post.
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
        }

        // Check if photo was uploaded.
        if ($file = $request->file('photo_id')) {
            // Concatenate current time and original file nme.
            $name = time() . $file->getClientOriginalName();

            // Move uploaded file into the directory for uploads.
            $file->move(Photo::UPLOAD_DIRECTORY, $name);

            // Create new record in database for the photo and assign that specific row with variable.
            $photo = Photo::create(['path' => $name]);

            // Update request with added photo id.
            $input['photo_id'] = $photo->id;
        }

        // Update user.
        $user->update($input);

        // Save message for show on the users list page.
        Session::flash('toastMessage', 'User ' . $user->name . ' has been updated.');

        // Redirect to the list of the users.
        return redirect()->route('admin.users.index');
    }

    /******************************************************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find user with specific ID.
        $user = User::findOrFail($id);

        // Delete user's photo from the directory.
        unlink(public_path() . $user->photo->path);

        // Remove user from the database.
        $user->delete();

        // Save message for show on the users list page.
        Session::flash('toastMessage', 'The user has been deleted.');

        // Redirect to the list of the users.
        return redirect()->route('admin.users.index');
    }
}
