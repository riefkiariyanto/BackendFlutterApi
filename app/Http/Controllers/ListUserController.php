<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use DB;

class ListUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('userlogin');
    // }
    public function index()
    {
        // $idClient = Auth::guard('client')->user()->id;

        $products = User::all();

        return view('admin.user', ['products' => $products]);
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

        return redirect('/client/add-product')->with('success','Product Added Successfully');

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // Delete associated records in the cart table
        //$user->carts()->delete();
    
        // Delete the user
        //$user->delete();
        $cart = DB::table('cart')->where('id_user',$id)->get();
        foreach ($cart as $key => $value) {
            DB::table('transaction')->where('id_cart',$value->id)->delete();
        }
        DB::table('cart')->where('id_user',$id)->delete();
        DB::table('users')->where('id',$id)->delete();
        return redirect('admin/user')->with('success','User successfully deleted');
    }

    public function activeOrDeactiveUser($id,$status)
    {
        DB::table('users')->where('id',$id)->update(['status'=>$status]);
        return redirect('admin/user')->with('success','User successfully '.$status.' ');
    }

    public function listUser(Request $request)
    {
        $user = User::all();
        
        return response([
            'totalData' => count($user) ,
            'data' => $user
        ], 200);
    }

    public function getUserById($id)
    {
        $user = User::findOrFail($id);

        return response([
            'data' => $user,
        ], 200);
    }

    public function postUser(Request $request)
    {
        $request->validated();

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($userData);
        $token = $user->createToken('backend_flutter')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function editUser(Request $request, $id)
    {
        $request->validated();

        $user = User::findOrFail($id);

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->has('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return response([
            'user' => $user,
        ], 200);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return Response::json(['message' => 'Data user berhasil dihapus'], 200);
    }
}
