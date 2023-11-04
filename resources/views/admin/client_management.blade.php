<x-admin-layout>
  
    <x-slot name="header">
    
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Management') }} 
        </h2>
    </x-slot>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" 
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">name</th>
                      <th scope="col">email</th>
                      <th scope="col">action</th>
                    </tr>
                  </thead>

                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>             
                        <button type="button" class="btn btn-success">edit</button>
                        <button type="button" class="btn btn-primary">detail</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                      </td>
                    </tr>

                  </tbody>
                </table>
                </div>
                <button type="button" class="btn btn-success">Success</button>


            </div>
        </div>
    </div>
</x-admin-layout>
