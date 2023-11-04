<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Profile;
use App\Models\BiodataShop;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idClient = Auth::guard('client')->user()->id;

        $biodata = BiodataShop::where('id_clients', $idClient)->get();

        if( count($biodata) > 0 ) {
            return view('client.profile', ['biodata' => $biodata]);
        }else{
            return view('client.formProfile');
        }
    }

    public function edit()
    {
        $idClient = Auth::guard('client')->user()->id;

        $biodata = BiodataShop::where('id_clients', $idClient)->get();

        return view('client.editProfile', ['biodata' => $biodata]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.formProfile');
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

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public', $logoName);

            $frontStore = $request->file('front_store');
            $frontStoreName = time() . '.' . $frontStore->getClientOriginalExtension();
            $frontStore->storeAs('public', $frontStoreName);
        }

        $data = [
            'id_clients' => $idUser,
            'store_name' => $request->input('store_name'),
            'address' => $request->input('address'),
            'no_telp' => $request->input('no_telp'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'logo' => $logoName,
            'front_store' => $frontStoreName,
        ];

        $product = Profile::create($data);

        return redirect('/client/profile')->with('message','Profile Added Successfully');

    }

    public function updateNew(Request $request)
    {
        $idUser = Auth::guard('client')->user()->id;

        $biodata = BiodataShop::where('id_clients', $idUser)->first(); // Use first() instead of get()

        if (!$biodata) {
            return redirect('/client/profile')->with('message', 'Profile Not Found');
        }

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public', $logoName);

            $biodata->logo = $logoName; // Use $logoName instead of $imageName
        }

        if ($request->hasFile('front_store')) {
            $frontStore = $request->file('front_store');
            $frontStoreName = time() . '.' . $frontStore->getClientOriginalExtension();
            $frontStore->storeAs('public', $frontStoreName);

            $biodata->front_store = $frontStoreName; // Use $frontStoreName instead of $imageName
        }

        $clientData = [
            'store_name' => $request->store_name,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ];

        $biodata->update($clientData);

        return redirect('/client/profile')->with('message', 'Profile Updated Successfully');
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
}
