<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'app_title' => 'Produk',
            'product' => Food::all(),
            'category' => Category::all()
        ];

        return view('food.index', $data);
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
        $pecah = substr($request->price, 4, 100);
        $validasi = $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'image' => 'required|image'
            ],
            [
                'name.required' => 'Nama harap diisi!',
                'price.required' => 'Harga harap diisi!',
                'category_id.required' => 'Kategori harap diisi!',
                'image.required' => 'Gambar harap diisi!',
                'image.image' => 'Harap masukan tipe gambar!',
            ]
        );

        if ($request->hasFile('image')) {
            $validasi['image'] = $request->file('image')->store('product');
        }

        $validasi['name'] = $request->name;
        $validasi['price'] = str_replace('.', '', $pecah);
        $validasi['category_id'] = $request->category_id;
        $validasi['active'] = 1;

        $cek = Food::create($validasi);

        return redirect('food')->with('message', "<script>Swal.fire('Selamat!', 'Data Berhasil Ditambahkan', 'success')</script>");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        $data = [
            'food' => $food,
            'category' => Category::all()
        ];

        return view('food.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $data = [
            'app_title' => 'Produk',
            'product' => Food::where('category_id', $id)->get(),
            'category' => Category::all()
        ];

        return view('food.detail', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        $validasi = $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'image' => 'image'
            ],
            [
                'name.required' => 'Nama harap diisi!',
                'price.required' => 'Harga harap diisi!',
                'category_id.required' => 'Kategori harap diisi!',
                'image.image' => 'Harap masukan tipe gambar!',
            ]
        );

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($food->image);
            $validasi['image'] = $request->file('image')->store('product');
        }

        $validasi['name'] = $request->name;
        $validasi['price'] = $request->price;
        $validasi['category_id'] = $request->category_id;
        $validasi['active'] = 1;

        $cek = Food::where('id', $food->id)->update($validasi);

        return back()->with('message', "<script>Swal.fire('Selamat!', 'Data Berhasil Disimpan', 'success')</script>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        Storage::disk('public')->delete($food->image);
        $cek =  Food::destroy($food->id);
        if ($cek) {
            echo 1;
        } else {
            echo 2;
        }
    }
}
