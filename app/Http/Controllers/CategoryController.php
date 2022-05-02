<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'app_title' => 'Kategori',
            'category' => Category::all()
        ];

        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required',
            'image' => 'required|image'
        ],
        [
            'name.required' => 'Nama kategori harap diisi!',
            'image.required' => 'Gambar harap diisi!',
            'image.image' => 'Harap masukan tipe gambar!',
        ]);

        if ($request->hasFile('image')) {
            $validasi['image'] = $request->file('image')->store('category');
        }

        $validasi['name'] = $request->name;
        $validasi['active'] = 1;

        $cek = Category::create($validasi);

        return back()->with('message', "<script>Swal.fire('Selamat!', 'Data Berhasil Ditambahkan', 'success')</script>");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $data = [
            'category' => $category
        ];

        return view('category.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validasi = $request->validate([
            'name' => 'required',
            'image' => 'image'
        ],
        [
            'name.required' => 'Nama kategori harap diisi!',
            'image.image' => 'Harap masukan tipe gambar!',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($category->image);
            $validasi['image'] = $request->file('image')->store('category');
        }

        $validasi['name'] = $request->name;
        $validasi['active'] = 1;

        $cek = Category::where('id', $category->id)->update($validasi);

        return back()->with('message', "<script>Swal.fire('Selamat!', 'Data Berhasil Disimpan', 'success')</script>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::disk('public')->delete($category->image);
        $cek =  Category::destroy($category->id);
        if ($cek) {
            echo 1;
        } else {
            echo 2;
        }
    }
}
