<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\BiodataShop;
use App\Models\Service;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idClient = Auth::guard('client')->user()->id;

        $products = Transaction::join('users', 'transaction.id_user', '=', 'users.id')
            ->select('transaction.*', 'users.*')
            ->where('id_client', $idClient)
            ->get();

        $cart = Transaction::join('cart', 'transaction.id_cart', '=', 'cart.id')
            ->join('products', 'cart.id_products', '=', 'products.id')
            ->select('cart.qty as qty_cart', 'products.*') // Select columns as needed
            ->where('transaction.id_client', $idClient)
            ->get();

        return view('client.transaction', ['products' => $products, 'cart' => $cart]);
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

    public function done(Request $request, $id)
    {
        // Find the product by ID
        $product = Transaction::find($id);

        if (!$product) {
            return redirect()->route('transaction.index')->with('error', 'Transaction not found');
        }

        // Update the product with the form data
        $data = [
            'status' => $request->input('status'),
        ];

        $product->update($data);

        // Redirect back to the product index page after updating
        return redirect('/client/transaction')->with('success','Transaction updated successfully');
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


    public function listCart()
    {
        $data = Cart::select('p.id as id_product', 'bt.id as id_bioadata_toko', 'cart.id_user', 'cart.id as id_cart', 'p.name as product_name', 'bt.store_name', 'cart.qty', 'p.image', 'p.price')
            ->join('products as p', 'p.id', 'cart.id_products')
            ->join('biodata_toko as bt', 'bt.id_clients', 'p.idclient')
            ->get();
    
        $groupedData = [];
    
        foreach ($data as $item) {
            $groupKey = $item['id_bioadata_toko'] . '-' . $item['id_user'];
    
            if (!isset($groupedData[$groupKey])) {
                $groupedData[$groupKey] = [
                    'id_bioadata_toko' => $item['id_bioadata_toko'],
                    'id_user' => $item['id_user'],
                    'store_name' => $item['store_name'],
                    'products' => [],
                ];
            }
    
            $productKey = $item['id_product'];
    
            // Cek apakah produk sudah ada dalam grup ini
            $productExists = false;
            foreach ($groupedData[$groupKey]['products'] as $product) {
                if ($product['id_product'] === $productKey) {
                    $productExists = true;
                    break;
                }
            }
    
            // Jika produk belum ada, tambahkan ke grup
            if (!$productExists) {
                $groupedData[$groupKey]['products'][] = [
                    'id_cart' => $item['id_cart'],
                    'id_product' => $item['id_product'],
                    'product_name' => $item['product_name'],
                    'image' => $item['image'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                ];
            }
        }
    
        $result = array_values($groupedData);
    
        return response([
            'totalData' => count($data),
            'data' => $result
        ], 200);
    }
    
    public function updateCartQuantity(Request $request, $cartId)
    {
        $request->validate([
            'qty' => 'required|integer|min:1', // Assuming qty should be a positive integer
        ]);
    
        $cart = Cart::find($cartId);

        if (!$cart) {
            return response(['message' => 'Cart not found'], 404);
        }
        $cart->qty = $request->input('qty');
        $cart->save();
        return response(['message' => 'Quantity updated successfully', 'cart' => $cart], 200);
    }

    public function deleteByIdCart($id)
    {
        try {
            $cart = Cart::find($id);
    
            if (!$cart) {
                return response()->json(['message' => 'Item Cart tidak ditemukan'], 404);
            }
            $cart->delete();
            
            return response()->json(['message' => 'Item Cart berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data'], 500);
        }
    }

    public function getServiceById($id)
    {
        $data = Cart::findOrFail($id);

        return response([
            'data' => $data,
        ], 200);
    }

    public function postCart(Request $request)
    {
        $product = Product::find($request->input('id_products'));
        $toko = BiodataShop::where('id_clients', $product->idclient)->first();
        $data = [
            'id_products' => $request->input('id_products'),
            'id_biodata_toko' => $toko->id,
            'id_user' => $request->input('id_user'),
            'qty' => $request->input('qty'),
            'date' => $request->input('date'),
            'status' => $request->input('status'),
        ];

        $create = Cart::create($data);

        return response([
            'data' => $create,
        ], 200);
    }

    public function postCartId(Request $request)
{
    // Check if the combination of id_products and id_user already exists in the Cart table
    $existingCartEntry = Cart::where('id_products', $request->input('id_products'))
        ->where('id_user', $request->input('id_user'))
        ->first();

    if ($existingCartEntry) {
        return response([
            'message' => 'Item already exists in the cart.',
        ], 400);
    }

    $product = Product::find($request->input('id_products'));
    $toko = BiodataShop::where('id_clients', $product->idclient)->first();
    $data = [
        'id_products' => $request->input('id_products'),
        'id_biodata_toko' => $toko->id,
        'id_user' => $request->input('id_user'),
        'qty' => $request->input('qty'),
        'date' => $request->input('date'),
        'status' => $request->input('status'),
    ];

    $create = Cart::create($data);

    return response([
        'data' => $create,
    ], 200);
}
    public function editCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $data = [
            'id_products' => $request->input('id_products'),
            'id_user' => $request->input('id_user'),
            'qty' => $request->input('qty'),
            'date' => $request->input('date'),
            'status' => $request->input('status'),
        ];

        $cart->update($data);

        return response([
            'data' => $cart,
        ], 200);
    }
    public function getIdProductAndIdUser()
    {
        $data = Cart::select('id_products', 'id_user','id')->get();
        
        return response()->json(['data' => $data]);
    }
    
    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return response()->json(['message' => 'Data cart berhasil dihapus'], 200);
    }



    public function listTransaction(Request $request)
    {
        $data = Transaction::all();

        return response([
            'totalData' => count($data) ,
            'data' => $data
        ], 200);
    }

    public function getTransactionById($id)
    {
        $data = Transaction::findOrFail($id);

        return response([
            'data' => $data,
        ], 200);
    }

    public function postTransaction(Request $request)
    {
        $data = [
            'code' => $request->input('code'),
            'id_cart' => $request->input('id_cart'),
            'id_client' => $request->input('id_client'),
            'id_user' => $request->input('id_user'),
            'status' => $request->input('status'),
            'date' => $request->input('date')
        ];

        $create = Transaction::create($data);

        return response([
            'data' => $create,
        ], 201);
    }

    public function editTransaction(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $data = [
            'code' => $request->input('code'),
            'id_cart' => $request->input('id_cart'),
            'id_client' => $request->input('id_client'),
            'id_user' => $request->input('id_user'),
            'status' => $request->input('status'),
            'date' => $request->input('date'),
        ];

        $transaction->update($data);

        return response([
            'data' => $transaction,
        ], 200);
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Data transaksi berhasil dihapus'], 200);
    }
}
