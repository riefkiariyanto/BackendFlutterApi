<x-client-layout>
  <x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List Produk
        </h2>
        <a href="<?=route('client.add-service')?>">
          <button class="border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-md">Tambah Layanan</button>
        </a>
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
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Gambar</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Nama Layanan</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Kategori</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Deskripsi</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Harga</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Status</th>
                          <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $loop->index + 1 }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">
                              <img data-bs-toggle="modal" data-bs-target="#editImage{{ $product->id }}" style="width: 40%; border-radius: 6px;" src="{{ asset('storage/' . $product->image) }}" alt="Service Image">
                            </td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->name }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->category }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->description }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->price }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left">{{ $product->status }}</td>
                            <td class="border-b p-4 pl-8 pt-3 pb-3 text-slate-400 text-left d-flex">
                              <input type="hidden" name="product_id" value="{{ $product->id }}">
                              <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                  Edit
                              </button>

                              <div class="modal fade" id="editImage{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="editModalLabel">Edit Gambar</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              <form action="{{ route('service.image', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')
                                                  <div class="form-group">
                                                      <label for="exampleFormControlInput1" class="form-label">Gambar Produk:</label>
                                                      <input class="form-control" name='image' type="file" id="image">
                                                  </div>

                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST">
                                                  @csrf
                                                  @method('PUT')

                                                  <!-- Add input fields for editing product details -->
                                                  <div class="form-group">
                                                      <label for="name">Nama:</label>
                                                      <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                                  </div>

                                                  <div class="form-group">
                                                      <label for="category">Kategori:</label>
                                                      <input type="text" class="form-control" name="category" value="{{ $product->category }}">
                                                  </div>

                                                  <div class="form-group">
                                                      <label for="category">Deskripsi:</label>
                                                      <textarea class="form-control" name="description" rows="4">{{ $product->description }}</textarea>
                                                  </div>

                                                  <div class="form-group">
                                                      <label for="category">Stok:</label>
                                                      <input type="number" class="form-control" name="qty" value="{{ $product->qty }}">
                                                  </div>

                                                  <div class="form-group">
                                                      <label for="price">Price:</label>
                                                      <input type="number" class="form-control" name="price" value="{{ $product->price }}">
                                                  </div>

                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">Delete</button>
                              </form>

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
