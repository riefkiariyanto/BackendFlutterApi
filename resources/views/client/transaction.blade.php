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
                        @foreach ($products as $product)
                        <tr>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $loop->index + 1 }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->name }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->code }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->status }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->date }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left d-flex">
                              <input type="hidden" name="product_id" value="{{ $product->id }}">
                              <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                  Detail
                              </button>

                              <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="editModalLabel">Detail Product</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                                  <!-- Add input fields for editing product details -->
                                                  @foreach ($cart as $cart)
                                                  <div style="
                                                    border: 1px solid;
                                                    border-radius: 10px;
                                                    padding: 12px;">
                                                    <div class="form-group">
                                                        <label for="name">Nama Product:</label>
                                                        <h5>
                                                          {{ $cart->name }}
                                                        </h5>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Harga Product:</label>
                                                        <h5>
                                                          {{ $cart->price }}
                                                        </h5>
                                                    </div>
                                                  </div>
                                                  @endforeach

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
                                  <button type="submit" class="btn btn-danger">Delete</button>
                              </form>

                              <!-- <form action="{{ route('transaction.done', ['id' => $product->id]) }}" method="POST"> -->
                                 <!--  @csrf
                                  @method('PUT') -->
                                  <button class="btn btn-success ml-2" data-bs-toggle="modal" data-bs-target="#validationModal{{ $product->id }}">Validation</button>
                              <!-- </form> -->

                              <div class="modal fade" id="validationModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Validasi Transaksi {{ $product->code }}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="{{ route('transaction.done', ['id' => $product->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                      <div class="modal-body">
                                        <select class="form-control" id="status" name="status">
                                          <option value="Pending">
                                            Pending
                                          </option>
                                          <option value="Diterima">
                                            Diterima
                                          </option>
                                          <option value="Selesai">
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
