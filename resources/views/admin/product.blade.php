<x-admin-layout>
  <x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List Client
        </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 table-responsive">
                <table class="border-collapse table-auto w-full text-sm">
                    <thead>
                        <tr>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">No</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Gambar</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Nama</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Nama Toko</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Price</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Qty</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Category</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Description</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $product)
                        <tr>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $loop->index + 1 }}</td>
                            <td class="border-b text-slate-400 text-left">
                              <img style="width: 80px; border-radius: 6px;" src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                            </td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->name }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->store_name }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">Rp{{ number_format($product->price) }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->qty }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->category }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->description }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left d-flex">
                                <a href="{{url('admin/product/delete/'.$product->id)}}" 
                                   onclick="return confirm('Yakin untuk delete product?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
  </div>
</x-admin-layout>
