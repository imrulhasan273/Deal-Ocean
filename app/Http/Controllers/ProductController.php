<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Product;
use App\Category;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;


class ProductController extends Controller
{
    public function details(Product $product)
    {

        $reviews = Review::where('product_id', $product->id)->get();

        $avg_rating = 0;
        $count = 0;
        foreach ($reviews as $review) {
            $count++;
            $avg_rating = ($avg_rating + $review->rating) / $count;
        }

        // dd($avg_rating);

        return view('product.single_product', compact('product', 'reviews', 'avg_rating', 'count'));
    }

    # For multiple products
    public function products(Product $product)
    {
        $categories = Category::where('parent_id', $product->id)->get();

        # ----------------
        $stack = array();
        $result = array();

        $catwithChildCat = $this->CategoryRecursion($product->id, $categories, $stack, $result);
        $products = DB::table('products')->whereIn('category_id', $catwithChildCat)->paginate(12);

        return view('product.multiple_product', compact('categories', 'products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%$query%")->paginate(12);

        $categories = Category::where('parent_id', 0)->get();

        return view('product.multiple_product', compact('categories', 'products'));
    }

    function CategoryRecursion($prod, $categories, $stack, $result)
    {
        //initially $prod = prod id, $categories = Collection, $stack = [], $result = []
        array_push($result, $prod);

        foreach ($categories as $cat) {
            array_push($stack, $cat->id);
        }

        $pop = array_pop($stack);
        $cats = Category::where('parent_id', $pop)->get();
        $countCats = $cats->count();

        if ($stack == null && $countCats == 0) {
            array_push($result, $pop);
            return $result;
        } else {
            return $this->CategoryRecursion($pop, $cats, $stack, $result);
        }
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
        $categories = Category::all();

        return view('dashboard.products.add', compact('shops', 'user_id', 'role', 'categories'));
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
            'category_id' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'shop_id' => 'required',
            'product_img' => 'required',
        ]);

        $imageName = $this->storeNewImage($request->file('product_img'));

        $addProduct = Product::create([
            'name' => $request->input('product_name'),
            'category_id' => $request->input('category_id'),
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
        $categories = Category::all();
        return view('dashboard.products.edit', compact(['product', 'categories']));
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
                    'category_id' => $request->category_id,
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
                'category_id' => $request->category_id,
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
