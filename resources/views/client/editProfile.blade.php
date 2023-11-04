<x-client-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Toko
            </h2>

            <a href="/client/profile">
                <button class="btn btn-primary">
                    View Profile
                </button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('client.update-profile') }}" class="px-4" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @foreach ($biodata as $biodata)
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <img 
                                    src="{{ asset('storage/' . $biodata->logo) }}" 
                                    class="img-fluid w-full mb-4 rounded" 
                                    alt="Logo Toko"
                                >

                                <label for="formFile" class="form-label">Logo Toko:</label>
                                <input class="form-control" name='logo' type="file" id="formFile">

                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">

                                <img 
                                    src="{{ asset('storage/' . $biodata->front_store) }}" 
                                    class="img-fluid w-full mb-4 rounded" 
                                    alt="Logo Toko"
                                >

                                <label for="formFile" class="form-label">Foto Bagian Depan Toko:</label>
                                <input class="form-control" name='front_store' type="file" id="formFile">

                              </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Toko:</label>
                            <input type="text" value="{{ $biodata->store_name }}" class="form-control" name="store_name" id="exampleFormControlInput1">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">No Telp:</label>
                            <input type="text" value="{{ $biodata->no_telp }}" class="form-control" name="no_telp" id="exampleFormControlInput1">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Alamat:</label>
                            <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="5">
                                {{ $biodata->address }}
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Latitude:</label>
                            <input type="text" value="{{ $biodata->latitude }}" class="form-control" name="latitude" id="exampleFormControlInput1">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">longitude:</label>
                            <input type="text" value="{{ $biodata->longitude }}" class="form-control" name="longitude" id="exampleFormControlInput1">
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-button class="btn btn-primary w-full">
                            {{ __('Update Product') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-client-layout>
