
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <link rel="stylesheet" href="/assets/css/bootstrap.css">
</head>
<body>
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
   
     <div class="container">
        <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card mt-3 p-3">
        <form action="{{ url('update/'.$graphicsUpload->id) }}" method="POST" enctype="multipart/form-data">
           @csrf
           @method('PUT')
           <div class="form-group">
            <label>image</label>
           <input type="file" name="graphics" placeholder="image" class="form-control"> 
           <img src="{{ asset('/assets/img/'.$graphicsUpload->graphics) }}"  width="80px" height="80px" alt="image"> </td>
           </div>
         
           <button type="submit"  class="btn btn-dark">Update</button>
        
      
        </form>
    </div>
</div>
</div>
</div>
        
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

</body>
</html>

