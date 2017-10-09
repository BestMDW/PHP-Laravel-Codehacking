<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminMediasController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get all photos.
        $photos = Photo::paginate(15);

        // Load view from the resource "resources/admin/media/index.blade.php"
        return view('admin.media.index', compact('photos'));
    }

    /******************************************************************************************************************/

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // Load view from the resource "resources/admin/media/create.blade.php"
        return view('admin.media.create');
    }

    /******************************************************************************************************************/

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
        $file = $request->file('file');

        // Make the file name unique.
        $name = time() . $file->getClientOriginalName();

        // Save the file in the photo upload directory.
        $file->move(Photo::UPLOAD_DIRECTORY, $name);
        // Create new record in the database.
        Photo::create(['path' => $name]);
    }

    /******************************************************************************************************************/

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        // Find the photo with specific ID.
        $photo = Photo::findOrFail($id);

        // Remove file from the storage.
        unlink(public_path() . $photo->path);

        // Delete photo from the database.
        $photo->delete();

        // Redirect to the list of the media.
        return redirect()->route('admin.media.index');
    }

    /******************************************************************************************************************/

    /**
     * Bulk media delete.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMedia(Request $request)
    {
        if (!empty($request->checkBoxArray))
        {
            // Get all photos for deletion.
            $photos = Photo::findOrFail($request->checkBoxArray);

            // Loop all records, remove files and delete from the database.
            foreach ($photos as $photo)
            {
                @unlink($photo->path);
                $photo->delete();
            }
        }

        // Redirect to the list of the media.
        return redirect()->back();
    }
}
