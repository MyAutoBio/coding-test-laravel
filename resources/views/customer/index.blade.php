@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Customer List</h1>

    <form method="GET" action="{{ route('customers.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="email" class="form-control" placeholder=" Email" value="{{ request('email') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="order_number" class="form-control" placeholder="Order Number" value="{{ request('order_number') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="item_name" class="form-control" placeholder="Item Name" value="{{ request('item_name') }}">
            </div>
        </div>
        <div class="form-row mt-2">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search Customer</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            @if($customers->isEmpty())
                <p>No customers found.</p>
            @else
               <table class="table">
                <tr><td>Customer Name</td><td>Email</td><td>Order Info</td>
                    @foreach($customers as $customer)
                        <tr>
                           <td> <strong>{{ $customer->name }}</strong> </td><td>({{ $customer->email }})</td>
                           <td>
                            <ul>
                                @foreach($customer->orders as $order)
                                    <li>
                                        <strong>Order #{{ $order->order_number }}</strong>
                                        <ul>
                                            @foreach($order->items as $item)
                                                <li>{{ $item->name }}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                    </td>
                    @endforeach
               </table>
            @endif

            <div class="mt-2">
                 {{ $customers->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
