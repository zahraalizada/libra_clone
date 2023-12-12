<?php

namespace Modules\Author\Http\Controllers;


use App\Services\ImageServices;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\Author\Entities\Author;


use Intervention\Image\Drivers\Imagick\Driver;
use Psy\Util\Str;


class AuthorController extends Controller
{
    private ImageServices $imageServices;

    public function __construct(ImageServices $imageServices)
    {
        $this->imageServices = $imageServices;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $authors = Author::orderBy('name', 'asc')->get();
        return view('author::index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('author::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
//        if ($request->hasFile('image')) {
//            // variable = file-dan gelen image-> hashName ile unikal ad yarat
//            $hashName = $request->file('image')->hashName();
//            // request-den image ile gelen fayli -> store et storage-app-public papkasinda avatars adli papka yarat ve fayli yukle)
//            $request->file('image')->storeAs('avatars', $hashName);
//        }


        if ($request->hasFile('image')) {
            // Papka yolunu al
            $dosya = $request->file('image');
            // HashName ile dosyaya benzersiz bir ad ver
            $hashName = $dosya->hashName();

            $this->imageServices->setFile($dosya)
                ->setWidth(300)
                ->setHeight(300)
                ->setFolderName("sm")
                ->resize()
                ->upload();

            $this->imageServices->setFile($dosya)
                ->setFolderName("md")
                ->setWidth(500)
                ->setHeight(500)
                ->resize()
                ->upload();

            $this->imageServices->setFile($dosya)
                ->setFolderName("lg")
                ->setWidth(700)
                ->setHeight(700)
                ->resize()
                ->upload();
        }

        Author::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $hashName
        ]);

        return redirect()->route('author.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('author::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $author = Author::find($id);
        return view('author::edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $hashName = $request->file('image')->hashName();
            $request->file('image')->storeAs('avatars', $hashName);
        }

        $author = Author::find($id);
        $author->update([
            'name' => $request->name,
            'description' => $request->name,
            'image' => $request->image
        ]);

        return redirect()->route('author.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();

        return redirect()->route('author.index');
    }
}
