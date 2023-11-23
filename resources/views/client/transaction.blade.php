<x-client-layout>
  <x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Transaksi
        </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <table class="border-collapse table-auto w-full text-sm">
                    <thead>
                        <tr>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">No</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Nama Pelanggan</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Kode Transaksi</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Status</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Tanggal Transaksi</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $product)
                        <tr>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $loop->index + 1 }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->user_name }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->code }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->status }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->date }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left d-flex">
                              <input type="hidden" name="product_id" value="{{ $product->id }}">
                              <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                  Detail
                              </button>

                              <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-xl">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="editModalLabel">Detail Product</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                                  <!-- Add input fields for editing product details -->
                                                 
                                                  <div style="
                                                    border: 1px solid;
                                                    border-radius: 10px;
                                                    padding: 12px;">
                                                    <p align="center">Detail Product</p>
                                                    <div class="form-group">
                                                        <label for="name">Nama:</label>
                                                        <h5>
                                                          {{ $product->product_name }}
                                                        </h5>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Harga:</label>
                                                        <h5>
                                                          Rp{{ number_format($product->product_price) }}
                                                        </h5>
                                                    </div>
                                                  </div>
                                                 
                                                  <div style="
                                                    border: 1px solid;
                                                    margin-top: 4%;
                                                    border-radius: 10px;
                                                    padding: 12px;">
                                                    <p align="center">Detail Pelanggan</p>
                                                    <div class="form-group">
                                                        <label for="name">Nama:</label>
                                                        <h5>
                                                          {{ $product->user_name }}
                                                        </h5>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Email:</label>
                                                        <h5>
                                                         {{$product->user_email}}
                                                        </h5>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Phone:</label>
                                                        <h5>
                                                         {{$product->user_phone}}
                                                        </h5>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Address:</label>
                                                        <h5>
                                                         {{$product->user_address}}
                                                        </h5>
                                                    </div>
                                                  </div>

                                                  <div style="
                                                    border: 1px solid;
                                                    border-radius: 10px;
                                                    margin-top: 4%;
                                                    padding: 12px;">
                                                    <p align="center">Detail Toko</p>
                                                    <div class="form-group">
                                                        <label for="name">Nama:</label>
                                                        <h5>
                                                          {{ $product->store_name }}
                                                        </h5>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Phone:</label>
                                                        <h5>
                                                         {{$product->no_telp}}
                                                        </h5>
                                                    </div>
                                                  </div>

                                                  <div style="
                                                    border: 1px solid;
                                                    border-radius: 10px;
                                                    margin-top: 4%;
                                                    padding: 12px;">
                                                    <p align="center">Detail Pemilik Toko</p>
                                                    <div class="form-group">
                                                        <label for="name">Nama:</label>
                                                        <h5>
                                                          {{ $product->client_name }}
                                                        </h5>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Phone:</label>
                                                        <h5>
                                                         {{$product->no_telp}}
                                                        </h5>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <form action="{{ route('transaction.delete', ['id' => $product->id]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" onclick="return confirm('Yakin untuk delete data?')" class="btn btn-danger">Delete</button>
                              </form>

                              <button class="btn btn-success ml-2" data-bs-toggle="modal" data-bs-target="#validationModal{{ $product->id }}">Validation</button>
                              <div class="modal fade" id="validationModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Validasi Transaksi {{ $product->code }}</h5>
                                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="{{ route('transaction.done', ['id' => $product->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                      <div class="modal-body">
                                        <select class="form-control" id="status" name="status">
                                          <option value="pending" {{$product->status == 'pending' ? 'selected' : ''}}>
                                            Pending
                                          </option>
                                          <option value="dibayar" {{$product->status == 'dibayar' ? 'selected' : ''}}>
                                            Dibayar
                                          </option>
                                          <option value="proses" {{$product->status == 'proses' ? 'selected' : ''}}>
                                            Proses
                                          </option>
                                          <option value="dikirim" {{$product->status == 'dikirim' ? 'selected' : ''}}>
                                            Dikirim
                                          </option>
                                          <option value="selesai" disabled {{$product->status == 'selesai' ? 'selected' : ''}}>
                                            Selesai
                                          </option>
                                        </select>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Validation</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</x-client-layout>
