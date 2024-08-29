<div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between">
    <div class="flex items-center mb-2 md:mb-0">
        <form method="GET" action="{{ route('customers.index') }}" class="w-full flex">
            <input type="text" name="email" placeholder="Search by Email"
                class="border border-gray-300 rounded px-3 py-2 mr-2 w-full md:w-1/3"
                value="{{ request('email') }}">
            <input type="text" name="order" placeholder="Search by Order No."
                class="border border-gray-300 rounded px-3 py-2 mr-2 w-full md:w-1/3"
                value="{{ request('order') }}">
            <input type="text" name="item" placeholder="Search by Item Name"
                class="border border-gray-300 rounded px-3 py-2 w-full md:w-1/3"
                value="{{ request('item') }}">
            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2 m-2">Search</button>
            <a href="{{ route('customers.index') }}" class="bg-gray-300 text-gray-700 rounded px-4 py-2 m-2 text-center">Reset</a>
        </form>
    </div>
</div>

<!-- Active Filters Display -->
@if (request()->has('email') || request()->has('order') || request()->has('item'))
    <div class="mb-4">
        <h3 class="font-semibold">Active Filters:</h3>
        <ul class="list-disc pl-5">
            @if (request('email'))
                <li><strong>Email:</strong> {{ request('email') }}</li>
            @endif
            @if (request('order'))
                <li><strong>Order No:</strong> {{ request('order') }}</li>
            @endif
            @if (request('item'))
                <li><strong>Item Name:</strong> {{ request('item') }}</li>
            @endif
        </ul>
    </div>
@endif
