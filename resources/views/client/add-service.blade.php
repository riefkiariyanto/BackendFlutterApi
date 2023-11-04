  <x-client-layout>
    <x-slot name="header">
      <div class="flex justify-between">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ 'Tambahkan Layanan' }}
          </h2>
      </div>    
  </x-slot>


        <div class="py-12">
            <x-succes-status class="mb-4 alert alert-secondary" :status="session('message')" />
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="py-12 px-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                  <form action="{{ route('client.store-service') }}" class="px-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Gambar Layanan:</label>
                        <input class="form-control" name='image' type="file" id="image">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Layanan:</label>
                        <input class="form-control" name='name' type="text" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Kategori:</label>
                        <input class="form-control" name="category" type="text" id="category">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Harga Layanan:</label>
                        <input class="form-control" name="price" type="number" id="price">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Deskripsi:</label>
                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                    </div>
                    <div class="mb-3 form-check form-switch">
                        <label for="exampleFormControlInput1" class="form-label">Status Layanan:</label>
                        <input class="form-check-input" type="checkbox" name="status" role="switch" id="status">
                    </div>
                    <x-button class="mt-3 btn btn-primary">
                        {{ __('Tambahkan layanan') }}
                    </x-button>
                </form>
          </div>
      </div>
  </x-client-layout>
