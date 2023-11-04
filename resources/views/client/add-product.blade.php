  <x-client-layout>
    <x-slot name="header">
      <div class="flex justify-between">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ 'Add Product' }}
          </h2>
          <button class="border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-md">Add Product</button>
      </div>
  </x-slot>


        <div class="py-12">
            <x-succes-status class="mb-4 alert alert-secondary" :status="session('message')" />
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="py-12 px-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                  <form action="{{ route('client.store-product') }}" class="px-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Gambar Produk:</label>
                        <input class="form-control" name='image' type="file" id="image">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Produk:</label>
                        <input class="form-control" name='name' type="text" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Kategori:</label>
                        <input class="form-control" name="category" type="text" id="category">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Harga Produk:</label>
                        <input class="form-control" name="price" type="number" id="price">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Deskripsi:</label>
                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Stok Produk:</label>
                        <input class="form-control" name="qty" type="number" id="qty">
                    </div>
                    <x-button class="mt-3 btn btn-primary">
                        {{ __('Add Product') }}
                    </x-button>
                </form>
          </div>
      </div>
  </x-client-layout>
