<?php

namespace Modules\Author\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;
use Modules\Author\Entities\Author;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class AuthorController extends Controller
{
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
            // Dosya yolunu al
            $dosya = $request->file('image');


            // HashName ile dosyaya benzersiz bir ad ver
            $hashName = $dosya->hashName();

            // Resmi Intervention Image ile yükle
            $imageSm = Image::make($dosya);
            $imageMd = Image::make($dosya);
            $imageLg = Image::make($dosya);

            // Boyutu kontrol et ve gerekirse yeniden boyutlandır
            $imageSm->fit(300, 300);
            $imageMd->fit(500, 500);
            $imageLg->fit(700, 700);

            // Storage'a yükle (storage/app/public/avatars altına)
//            $image->storeAs('avatars', $hashName);
            $imageSm->save(storage_path('app/avatars/sm' . $hashName));
            $imageMd->save(storage_path('app/avatars/md' . $hashName));
            $imageLg->save(storage_path('app/avatars/lg' . $hashName));
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
