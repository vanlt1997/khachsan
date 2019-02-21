<?php

namespace App\Http\Controllers\Admin;

use App\Service\ImageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LibraryImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $images = $this->imageService->getImages();
        return view('admin.images.index', compact('images'));
    }

    public function actionSaveImage(Request $request)
    {
        if ($request->image !== null) {
            $image = $_FILES['image'];
            $name = uniqid() . "." . $image['name'];
            $filename = "images/admin/library-images/" . $name;
            move_uploaded_file($image['tmp_name'], $filename);
        }

        $this->imageService->create($name);
        return redirect()->route('admin.library-images.index');
    }

    public function actionDeleteImage($id)
    {
        $this->imageService->delete($id);
        return redirect()->route('admin.library-images.index');
    }
}
