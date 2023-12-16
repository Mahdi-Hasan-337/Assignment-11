<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <!-- Required meta tags --> --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <!-- Bootstrap CSS --> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <!-- Fontawesome cdn --> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Storekeeper</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Edit Product
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('update-product/'.$product->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="quantity">Total item?</label>
                                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Unit price</label>
                                <input type="number" name="unit_price" value="{{ $product->unit_price }}" class="form-control">
                            </div>
                            <div class="text-center form-group mb-3">
                                <button type="submit" class="col-12 btn btn-primary">Update</button>
                            </div>
                            <div class="text-center form-group mb-3">
                                <a href="{{ url('/') }}" class="col-12 btn btn-warning">back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</body>

</html>
