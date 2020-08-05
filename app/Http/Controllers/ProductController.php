<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;


class ProductController extends Controller
{
    public function details()
    {
        return view('product.single_product');
    }

    # For multiple products
    public function products(Product $product)
    {
        $categories = Category::where('parent_id', $product->id)->get();

        # --------------------------------------------------------------------
        $stack = array();




        foreach ($categories as $cat) {
            array_push($stack, $cat->id);
        }

        dd($stack);

        #----------------------------------------------------------------------

        // dd($categories);


        #------


        return view('product.multiple_product', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function add()
    {
        $shops = Shop::all();
        $user_id = Auth::user()->id;
        $role = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];

        return view('dashboard.products.add', compact('shops', 'user_id', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'shop_id' => 'required',
            'product_img' => 'required',
        ]);

        $imageName = $this->storeNewImage($request->file('product_img'));

        $addProduct = Product::create([
            'name' => $request->input('product_name'),
            'price' => $request->input('product_price'),
            'description' => $request->input('product_description'),
            'shop_id' => $request->input('shop_id'),
            'cover_img' => $imageName
        ]);

        return Redirect::route('dashboard.products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // dd('edit');
        return view('dashboard.products.edit', compact(['product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        # When update with a new photo
        if ($request->hasFile('product_img')) {

            $this->deleteOldImage($request->product_id);

            $imageName = $this->storeNewImage($request->file('product_img'));

            $updatingProduct = Product::where('id', $request->product_id)->first();
            if ($updatingProduct) {
                $updatingProduct->update([
                    'name' => $request->product_name,
                    'price' => $request->product_price,
                    'description' => $request->product_description,
                    'cover_img' => $imageName,
                ]);
            }

            return Redirect::route('dashboard.products');
        }


        # When no photo is updated
        $updatingProduct = Product::where('id', $request->product_id)->first();
        if ($updatingProduct) {
            $updatingProduct->update([
                'name' => $request->product_name,
                'price' => $request->product_price,
                'description' => $request->product_description,
            ]);
        }

        return Redirect::route('dashboard.products');
    }

    protected function deleteOldImage($prod_id)
    {
        $oldImg = DB::table('products')->where('id', $prod_id)->pluck('cover_img')->toArray();
        $name = $oldImg[0];
        Storage::delete('/public/products/' . $name);
    }

    protected function storeNewImage($file)
    {
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $file->storeAs('public/products', $fileNameToStore);

        return $fileNameToStore;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        DB::table('products')->where('id', $product->id)->delete();

        return Redirect::route('dashboard.products');
    }
}
