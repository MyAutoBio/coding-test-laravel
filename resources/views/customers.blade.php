<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #343a40;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .table {
            background-color: #ffffff;
            border-radius: .375rem;
            box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #007bff;
            color: #ffffff;
        }

        .table tbody tr {
            transition: background-color 0.2s;
            line-height: 1.2;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 0.5rem;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .d-flex {
            margin-top: 20px;
        }

        .w-5,
        .h-5 {
            height: 12px !important;
        }

        .order-items {
            padding-left: 20px;
        }

        .collapse-content {
            padding: 0;
        }

        .toggle-btn {
            cursor: pointer;
            color: #007bff;
        }

        .toggle-btn:hover {
            text-decoration: underline;
        }

        /* Pagination styles */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item .page-link {
            color: #007bff;
            border-color: #dee2e6;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff;
        }

        .pagination .page-item .page-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        .text-muted
        {
            padding-right: 85px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="container">
            <h1>Customers</h1>
            <form action="{{ route('customers.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by Email, Order Number, or Item Name" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Orders & Items</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>
                            <span class="toggle-btn" data-bs-toggle="collapse"
                                data-bs-target="#orders-{{ $customer->id }}" aria-expanded="false"
                                aria-controls="orders-{{ $customer->id }}">
                                Show Orders
                            </span>
                            <div class="collapse collapse-content mt-2" id="orders-{{ $customer->id }}">
                                @foreach ($customer->orders as $order)
                                <div>
                                    <strong>Order #{{ $order->order_number }}</strong>
                                    <ul class="order-items">
                                        @foreach ($order->orderedItems as $item)
                                        <li>{{ $item->item->name }} (Qty: {{ $item->quantity }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Redesigned Pagination -->
            <div class="pagination-container">
                {{ $customers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
