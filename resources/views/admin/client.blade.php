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
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Logo</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Gambar Depan Toko</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Nama Pemilik</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Nama Toko</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Email</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Alamat</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">No Telp</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Latitude</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">longitude</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Status</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $loop->index + 1 }}</td>
                            <td class="border-b text-slate-400 text-left">
                              <img style="width: 80px; border-radius: 6px;" src="{{ asset('storage/' . $product->logo) }}" alt="Product Image">
                            </td>
                            <td class="border-b text-slate-400 text-left">
                              <img style="width: 80px; border-radius: 6px;" src="{{ asset('storage/' . $product->front_store) }}" alt="Product Image">
                            </td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->name }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->store_name }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->email }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->address }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->no_telp }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->latitude }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->longitude }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->status }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left d-flex">
                              <input type="hidden" name="product_id" value="{{ $product->id }}">

                              <form action="{{ route('client.delete', ['id' => $product->id_clients]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" onclick="return confirm('Yakin untuk delete client?')" class="btn btn-danger">Delete</button>
                              </form>

                             &nbsp;
                             @if($product->status == 'active')
                                <a href="{{url('admin/client/update_status/'.$product->id_clients.'/deactive')}}" 
                                   onclick="return confirm('Yakin untuk deactive client?')" class="btn btn-warning">Deactive</a>
                              @else
                                <a href="{{url('admin/client/update_status/'.$product->id_clients.'/active')}}"
                                   onclick="return confirm('Yakin untuk active client?')" class="btn btn-success">Active</a>
                              @endif
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
