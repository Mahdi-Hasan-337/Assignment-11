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
    <div class="d-flex" id="wrapper">
        <div class="bg-white d-flex flex-column" id="sidebar-wrapper">
            <div class="contents"
                style="display: flex; flex-direction: column; justify-content: space-between; flex-grow: 1;">
                <div class="list-group list-group-flush my-3">
                    <a href="#dashboard-content-wrapper" class="list-group-item list-group-item-action"
                        style="text-transform:uppercase;font-size:1.2rem; font-family:'Poppins',sans-serif; font-weight:bold;">
                        Storekeeper
                    </a>

                    <a href="#dashboard-content-wrapper" class="list-group-item list-group-item-action"
                        style="text-transform:uppercase;font-size:1.2rem; font-family:'Poppins',sans-serif; font-weight:bold;">
                        <i class="fas fa-tachometer-alt me-2"></i>Admin
                    </a>

                    <a href="#page-content-wrapper" class="list-group-item list-group-item-action"
                        style="text-transform:uppercase;font-size:1.2rem; font-family:'Poppins',sans-serif; font-weight:bold;">
                        <i class="fas fa-chart-line me-2"></i>Dashboard
                    </a>

                    <a href="#feedback-content-wrapper" class="list-group-item list-group-item-action"
                        style="text-transform:uppercase;font-size:1.2rem; font-family:'Poppins',sans-serif; font-weight:bold;">
                        <i class="fas fa-comments me-2"></i>History
                    </a>
                </div>
            </div>
        </div>

        {{-- <!-- Contents for dashboard --> --}}
        <div id="dashboard-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-bars fs-4 me-3" id="dashboard-menu-toggle"></i>
                    <h2 class="fs-2 m-0">Admin</h2>
                </div>
            </nav>

            <div class="container-fluid px-4">

                <div>
                    @if (SESSION('status'))
                        <div class="alert alert-success">{{ SESSION('status') }}</div>
                    @endif
                </div>
                <div>
                    <a href="{{ url('add-product') }}" class="btn btn-primary col-12 p-2 rounded">ADD+</a>
                </div>
                <div class="row my-5">
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stored At</th>
                                    <th scope="col">Last Updated At</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Sale</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td scope="col">{{ $product->id }}</td>
                                        <td scope="col">{{ $product->name }}</td>
                                        <td scope="col">{{ $product->quantity }}</td>
                                        <td scope="col">{{ $product->unit_price }}</td>
                                        <td scope="col">{{ $product->created_at }}</td>
                                        <td scope="col">{{ $product->updated_at }}</td>
                                        <td>
                                            <a href="{{ url('edit-product/' . $product->id) }}"
                                                class='col-6 btn btn-warning mb-2' style="display: inline">Update</a>
                                            <a href="{{ url('delete-product/' . $product->id) }}"
                                                class='col-6 btn btn-danger'>Delete</a>
                                        </td>
                                        <td>
                                            <form action="{{ url('sell-product/' . $product->id) }}" method="POST">
                                                @csrf
                                                <input type="number" name="quantity" required><br>
                                                <button type="submit" class="col-6 btn btn-warning mb-2"
                                                    style="display: inline">Sale</button>
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

        {{-- Contents for Analytics portion --}}
        <div id="page-content-wrapper" style="display:none;">
            <nav class="navbar navbar-expand-lg navbar-light py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-bars fs-4 me-3" id="analytics-menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashbaord</h2>
                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="text-center card-body">
                                <h5 class="card-title">Today's Sales</h5>
                                <p class="card-text">{{ $todaySales }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="text-center card-body">
                                <h5 class="card-title">Yesterday's Sales</h5>
                                <p class="card-text">{{ $yesterdaySales }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="text-center card-body">
                                <h5 class="card-title">This Month's Sales</h5>
                                <p class="card-text">{{ $thisMonthSales }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="text-center card-body">
                                <h5 class="card-title">Last Month's Sales</h5>
                                <p class="card-text">{{ $lastMonthSales }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contents for Feedback portion --}}
        <div id="feedback-content-wrapper" style="display:none;">
            <nav class="navbar navbar-expand-lg navbar-light py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-bars fs-4 me-3" id="feedback-menu-toggle"></i>
                    <h2 class="fs-2 m-0">Transaction History</h2>
                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="row my-5">
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    {{-- <th scope="col">Product ID</th> --}}
                                    <th scope="col">Quantity Sold</th>
                                    <th scope="col">Price Sold</th>
                                    <th scope="col">Sold At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($soldItems as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        {{-- <td>{{ $soldItem->name ?? 'N/A' }}</td> --}}
                                        <td>{{ $item->quantity_sold }}</td>
                                        <td>{{ $item->price_sold }}</td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
