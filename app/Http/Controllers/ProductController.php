<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\BiodataShop;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idClient = Auth::guard('client')->user()->id;

        $products = Product::where('idclient', $idClient)->get();

        $biodata = BiodataShop::where('id_clients', $idClient)->get();

        if( count($biodata) > 0 ) {
            return view('client.product', ['products' => $products]);
        }else{
            return view('client.formProfile');
        }

        // dd($products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.add-product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $idUser = Auth::guard('client')->user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);
        }

        $data = [
            'idclient' => $idUser,
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'qty' => $request->input('qty'),
            'image' => $imageName, // Simpan nama file gambar
        ];

        $product = Product::create($data);

        return redirect('/client/add-product')->with('message','Product Added Successfully');
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
        //
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
        // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found');
        }

        // Validate the form data (you can customize the validation rules based on your requirements)
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            // Add more validation rules as needed
        ]);

        // Update the product with the form data
        $product->update($request->all());

        // Redirect back to the product index page after updating
        return redirect('/client/product')->with('success','Product updated successfully');
    }

     public function image(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);
        }

        $data = [
            'image' => $imageName, // Simpan nama file gambar
        ];
        $product->update($data);
        return redirect('/client/product')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return redirect('/client/product')->with('error','Product not found');
        }

        // Delete the product
        $product->delete();

        return redirect('/client/product')->with('success','Product Delete Successfully');
    }

    public function showBiodataShop($id)
    {
        $biodataShop = BiodataShop::findOrFail($id);

        return response()->json([
            'id_clients' => $biodataShop->id_clients,
            'store_name' => $biodataShop->store_name,
            'no_telp' => $biodataShop->no_telp,
            'latitude' => $biodataShop->latitude,
            'longitude' => $biodataShop->longitude,
        ]);
    }

    public function listProductShop()
    {
        $productsWithShop = Product::with('shop')->get();
        $totalProducts = Product::count();

        return response()->json([
        'data' => $productsWithShop,
        'totalProducts' => $totalProducts
    ], 200);
    }

    public function listProduct(Request $request)
    {
        
        $clients = Product::all();
        return response([
            
            'totalData' => count($clients) ,
            'data' => $clients
        ], 200);
    }

    public function getProductById($id)
    {
        $product = Product::findOrFail($id);

        return response([
            'data' => $product,
        ], 200);
    }

    public function postProduct(Request $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);
        }

        $data = [
            'idclient' => $request->input('idclient'),
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'qty' => $request->input('qty'),
            'image' => $imageName
        ];

        $create = Product::create($data);

        return response([
            'data' => $create,
        ], 201);
    }

    public function editProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);

            if ($product->image !== null) {
                Storage::delete('public/' . $product->image);
            }

            $product->image = $imageName;
        }

        $product->idclient = $request->input('idclient');
        $product->name = $request->input('name');
        $product->category = $request->input('category');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->qty = $request->input('qty');

        $product->save();

        return response([
            'data' => $product,
        ], 200);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Data produk berhasil dihapus'], 200);
    }
}
