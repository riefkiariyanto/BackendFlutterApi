<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\BiodataShop;
use App\Models\Service;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
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
            'image' => $imageName, 
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
        // Get all carts
        $data = Cart::select('p.id as id_product', 'bt.id as id_bioadata_toko', 'cart.id_user', 'cart.id as id_cart', 'p.name as product_name', 'bt.store_name', 'cart.qty', 'p.image', 'p.price', 'bt.id_clients')
            ->join('products as p', 'p.id', 'cart.id_products')
            ->join('biodata_toko as bt', 'bt.id_clients', 'p.idclient')
            ->get();
    
        // Get carts with transactions
        $cartsWithTransactions = Transaction::pluck('id_cart')->toArray();
    
        // Filter out carts with transactions
        $filteredData = $data->filter(function ($item) use ($cartsWithTransactions) {
            return !in_array($item['id_cart'], $cartsWithTransactions);
        });
    
        // Group the filtered data
        $groupedData = [];
        foreach ($filteredData as $item) {
            $groupKey = $item['id_bioadata_toko'] . '-' . $item['id_user'];
    
            if (!isset($groupedData[$groupKey])) {
                $groupedData[$groupKey] = [
                    'id_client' => $item['id_clients'],
                    'id_bioadata_toko' => $item['id_bioadata_toko'],
                    'id_user' => $item['id_user'],
                    'store_name' => $item['store_name'],
                    'products' => [],
                    'total_price' => 0,
                ];
            }
    
            $productKey = $item['id_product'];
    
            $productExists = false;
            foreach ($groupedData[$groupKey]['products'] as &$product) {
                if ($product['id_product'] === $productKey) {
                    $productExists = true;
                    // Calculate the total price for this product
                    $product['total_price'] += $item['qty'] * $item['price'];
                    break;
                }
            }
    
            if (!$productExists) {
                $groupedData[$groupKey]['products'][] = [
                    'id_cart' => $item['id_cart'],
                    'id_product' => $item['id_product'],
                    'product_name' => $item['product_name'],
                    'image' => $item['image'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'total_price' => $item['qty'] * $item['price'],
                ];
            }
    
            $groupedData[$groupKey]['total_price'] += $item['qty'] * $item['price'];
        }
    
        // Convert to array values
        $result = array_values($groupedData);
    
        return response([
            'totalData' => count($filteredData),
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

    public function listTransactionCart(Request $request)
    {
        $transactions = Transaction::with('cart', 'user', 'cart.product', 'shop')->get();

        $result = [];
        $groupedData = [];

        foreach ($transactions as $transaction) {
            $cart = $transaction->cart;
            $user = $transaction->user;
            $shop = $transaction->shop;
            $product = $cart->product;
            $code = $transaction->code;

            if ($cart && $user && $shop && $product) {
                $total = $cart->qty * $product->price;

                if (!isset($groupedData[$code])) {
                   
                    $groupedData[$code] = [
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'phone' => $user->phone,
                            'address' => $user->address,
                       
                        ],
                        'code' => $code,
                        'id_client' => $shop->id_clients,
                        'id_bioadata_toko' => $shop->id_bioadata_toko,
                        'id_user' => $user->id,
                        'store_name' => $shop->store_name,
                        'products' => [],
                        'total_price' => 0,
                    ];
                }

                $groupedData[$code]['products'][] = [
                    'id_transaction' => $transaction->id,
                    'image' => $product->image, 
                    'status' => $transaction->status,
                    'id_cart' => $cart->id,
                    'id_product' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'qty' => $cart->qty,
                    'total_price' => $total,
                ];

                $groupedData[$code]['total_price'] += $total;
            }
        }

        $formattedData = [];

        foreach ($groupedData as $data) {
            $formattedData[] = $data;
        }

        return response([
            'totalData' => count($formattedData),
            'data' => $formattedData
        ], 200);
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
        ], 200);
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
