@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6">Customer Listing</h1>

        <form method="get" action="{{ route('customers.index') }}">
            @include('customer.partials.filters')
        </form>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="py-3 px-4 border-b">Name</th>
                    <th class="py-3 px-4 border-b">Email</th>
                    <th class="py-3 px-4 border-b">Orders</th>
                </tr>
            </thead>
            <tbody>
                @if (!$customers->isEmpty())
                    @foreach ($customers as $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-4 border-b">{{ $customer->name }}</td>
                            <td class="py-4 px-4 border-b">{{ $customer->email }}</td>
                            <td class="py-4 px-4 border-b">
                                <ul class="list-disc pl-5">
                                    @if (!$customer->orders->isEmpty())
                                        @foreach ($customer?->orders as $order)
                                            <li class="mb-2">
                                                <strong>Order #{{ $order->order_number }}</strong>
                                                ({{ $order->order_date }})
                                                <ul class="list-inside list-disc pl-5">
                                                    @foreach ($order?->items as $orderItem)
                                                        <li>
                                                            {{ $orderItem->item->name }} - {{ $orderItem->quantity }} @
                                                            ${{ number_format($orderItem->item->price, 2) }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="py-4 px-4 border-b text-center" colspan="3">No results found.</td>
                @endif
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="mt-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <span class="text-sm text-gray-600">
                        Showing {{ $customers->count() }} of {{ $customers->total() }} records
                    </span>
                </div>
                <div>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
