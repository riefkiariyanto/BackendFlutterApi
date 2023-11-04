<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\BiodataShop;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idClient = Auth::guard('client')->user()->id;

        $products = Service::where('idclient', $idClient)->get();

        $biodata = BiodataShop::where('id_clients', $idClient)->get();

        if( count($biodata) > 0 ) {
            return view('client.service', ['products' => $products]);
        }else{
            return view('client.formProfile');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.add-service');
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
            'status' => $request->input('status'),
            'image' => $imageName, // Simpan nama file gambar
        ];

        $product = Service::create($data);

        return redirect('/client/add-product')->with('message','Service Added Successfully');

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
        $product = Service::find($id);

        if (!$product) {
            return redirect()->route('service.index')->with('error', 'Service not found');
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
        return redirect('/client/service')->with('success','Service updated successfully');
    }


     public function image(Request $request, $id)
    {
        // Find the product by ID
        $product = Service::find($id);

        if (!$product) {
            return redirect()->route('service.index')->with('error', 'Product not found');
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
        return redirect('/client/service')->with('success','Service updated successfully');
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
        $product = Service::find($id);

        if (!$product) {
            return redirect('/client/service')->with('error','Service not found');
        }

        // Delete the product
        $product->delete();

        return redirect('/client/service')->with('success','Service Delete Successfully');
    }

    public function listService(Request $request)
    {
        $data = Service::all();

        return response([
            'totalData' => count($data) ,
            'data' => $data
        ], 200);
    }

    public function getServiceById($id)
    {
        $data = Service::findOrFail($id);

        return response([
            'data' => $data,
        ], 200);
    }

    public function postService(Request $request)
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
            'status' => $request->input('status'),
            'image' => $imageName, // Simpan nama file gambar
        ];

        $create = Service::create($data);

        return response([
            'data' => $create,
        ], 201);
    }

    public function editService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($service->image !== null) {
                Storage::delete('public/' . $service->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);

            $service->image = $imageName;
        }

        $data = [
            'idclient' => $request->input('idclient'),
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ];

        $service->update($data);

        return response([
            'data' => $service,
        ], 200);
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return Response::json(['message' => 'Data layanan berhasil dihapus'], 200);
    }
}
