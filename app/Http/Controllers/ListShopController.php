<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\BiodataShop;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ListShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $idClient = Auth::guard('client')->user()->id;

        $products = Client::join('biodata_toko', 'clients.id', '=', 'biodata_toko.id_clients')
            ->select('clients.*', 'biodata_toko.*')
            ->get();

        return view('admin.client', ['products' => $products]);
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

        public function listBiodataClient(Request $request)
    {
        $clients = Product::all();

        return response([
            'totalData' => count($clients) ,
            'data' => $clients
        ], 200);
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
    public function validateClient(Request $request, $id)
    {
        // Find the product by ID
        $product = Client::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Client not found');
        }

        // Validate the form data (you can customize the validation rules based on your requirements)
        $data = [
            'status' => 'Tervalidasi',
        ];

        $product->update($data);


        // Redirect back to the product index page after updating
        return redirect('/admin/client')->with('success','Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the client by ID
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        // Check for associated records in biodata_toko
        $associatedRecords = BiodataShop::where('id_clients', $id)->get();

        if ($associatedRecords->isNotEmpty()) {
            // Delete associated records
            BiodataShop::where('id_clients', $id)->delete();
        }

        // Delete the client
        $client->delete();

        return response()->json(['message' => 'Client and associated records deleted successfully'], 200);
        
    }
    
    
    public function listClient(Request $request)
    {
        $clients = Client::all();

        return response([
            'totalData' => count($clients) ,
            'data' => $clients
        ], 200);
    }


    public function getClientById($id)
    {
        $data = Client::findOrFail($id);

        return response([
            'data' => $data,
        ], 200);
    }

    public function getBiodataClient(Request $request)
    {
        $data = BiodataShop::all();

        return response([
            'data' => $data,
        ], 200);
    }
    public function getAllShopsAndProducts()
    {
        $allShops = BiodataShop::with('products')->get();

        return response([
            'data'=>$allShops,
        ],200);
    }
    
    public function getShopAndProductsById($id)
{
    $shop = BiodataShop::with('products')->find($id);

    if (!$shop) {
        return response(['message' => 'Shop not found'], 404);
    }

    return response(['data' => $shop], 200);
}
 public function listBiodata()
    {   
        $biodataList = BiodataShop::all();

        return view('biodata.list', ['biodataList' => $biodataList]);
    }
    public function postClient(Request $request)
    {
        $clientData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Pending',
        ];

        $client = client::create($clientData);

        return response([
            'user' => $client,
        ], 201);
    }

    public function editClient(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $clientData = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ];

        if ($request->has('password')) {
            $clientData['password'] = Hash::make($request->password);
        }

        $client->update($clientData);

        return response([
            'client' => $client,
        ], 200);
    }

    public function deleteClient($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['message' => 'Data client berhasil dihapus'], 200);
    }

    public function getBiodataClientById($id)
    {
        $data = BiodataShop::findOrFail($id);

        return response()->json(['data' => $data], 200);
    }

    public function postBiodataClient(Request $request)
    {
        if ($request->hasFile('front_store')) {
            $image = $request->file('front_store');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);
        }

        if ($request->hasFile('logo')) {
            $imageLogo = $request->file('logo');
            $imageNameLogo = time() . '.' . $imageLogo->getClientOriginalExtension();
            $imageLogo->storeAs('public', $imageNameLogo);
        }

        $clientData = [
            'id_clients' => $request->id_clients,
            'store_name' => $request->store_name,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'logo' => $imageNameLogo,
            'front_store' => $imageName,
            'status' => 'Pending',
        ];

        $client = BiodataShop::create($clientData);

        return response([
            'data' => $client,
        ], 201);
    }

    public function editBiodataClient(Request $request, $id)
    {
        $request->validated();

        $client = BiodataShop::findOrFail($id);

        // Handle logo image upload
        if ($request->hasFile('logo')) {
            // Delete the old logo image if it exists
            if ($client->logo !== null) {
                Storage::delete('public/' . $client->logo);
            }

            $imageLogo = $request->file('logo');
            $imageNameLogo = time() . '.' . $imageLogo->getClientOriginalExtension();
            $imageLogo->storeAs('public', $imageNameLogo);

            $client->logo = $imageNameLogo;
        }

        // Handle front store image upload
        if ($request->hasFile('front_store')) {
            // Delete the old front store image if it exists
            if ($client->front_store !== null) {
                Storage::delete('public/' . $client->front_store);
            }

            $image = $request->file('front_store');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);

            $client->front_store = $imageName;
        }

        $clientData = [
            'id_clients' => $request->id_clients,
            'store_name' => $request->store_name,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => $request->status,
        ];

        $client->update($clientData);

        return response([
            'data' => $client,
        ], 200);
    }

    public function deleteBiodataClient($id)
    {
        $bio = BiodataShop::findOrFail($id);
        $bio->delete();

        return response()::json(['message' => 'Data toko berhasil dihapus'], 200);
    }

}

