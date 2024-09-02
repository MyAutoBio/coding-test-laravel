<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Listing</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">

    <!-- Optional Bootstrap Icons (CDN) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<div class="container mt-4">
    <!-- Search Form -->
    <form method="GET" action="{{ route('customers.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by email, order number, or item name">
            <button type="submit" class="btn btn-primary">Search</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='/'">Clear</button>
        </div>
    </form>

    <!-- Page Title -->
    <h1 class="mb-4">Customer Listing</h1>

    <!-- Customers Table -->
    @if($customers->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Orders</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($customer->orders as $order)
                                    <li>
                                        <strong>Order Number:</strong> {{ $order->order_number }}
                                        <ul class="list-unstyled ms-4">
                                            @foreach($order->items as $item)
                                                <li>Item: {{ $item->name }}, Price: ${{ $item->price }}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        {{ $customers->links('pagination::bootstrap-4')}}
    @else
        <p>No customers found.</p>
    @endif
</div>

<!-- Bootstrap JS (CDN) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
</body>
</html>
