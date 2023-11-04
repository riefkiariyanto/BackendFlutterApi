<x-client-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile Toko
            </h2>

            <a href="/client/edit-profile">
                <button class="btn btn-primary">
                    Edit Profile
                </button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">           
                        @foreach ($biodata as $biodata)
                        <div class="row mb-3">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label for="formFile" class="form-label">Logo Toko:</label>
                                <img 
                                    src="{{ asset('storage/' . $biodata->logo) }}" 
                                    class="img-fluid w-full mb-4 rounded" 
                                    alt="Logo Toko"
                                >
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">

                                <label for="formFile" class="form-label">Foto Bagian Depan Toko:</label>
                                <img 
                                    src="{{ asset('storage/' . $biodata->front_store) }}" 
                                    class="img-fluid w-full mb-4 rounded" 
                                    alt="Logo Toko"
                                >

                              </div>
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-between items-center">
                            <label for="exampleFormControlInput1" class="form-label">Nama Toko:</label>
                            <h1 class="badge-custom">{{ $biodata->store_name }}</h1>
                        </div>

                        <div class="mb-3 d-flex justify-content-between items-center">
                            <label for="exampleFormControlInput1" class="form-label">No Telp:</label>
                            <h1 class="badge-custom">{{ $biodata->no_telp }}</h1>
                        </div>

                        <div class="mb-3 d-flex justify-content-between items-center">
                            <label for="exampleFormControlInput1" class="form-label">Alamat:</label>
                            <h1 class="badge-custom">{{ $biodata->address }}</h1>
                        </div>

                        <div class="mb-3 d-flex justify-content-between items-center">
                            <label for="exampleFormControlInput1" class="form-label">Latitude:</label>
                            <h1 class="badge-custom">{{ $biodata->latitude }}</h1>
                        </div>

                        <div class="mb-3 d-flex justify-content-between items-center">
                            <label for="exampleFormControlInput1" class="form-label">Longitude:</label>
                            <h1 class="badge-custom">{{ $biodata->longitude }}</h1>
                        </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
</x-client-layout>
