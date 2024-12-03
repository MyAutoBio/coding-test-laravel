<x-layouts.app>
    <!-- Customers -->
    <div class="px-10">
        <p class="font-bold text-2xl text-black mt-10">{{ __('Customers') }}</p>

        <!-- Search panel -->
        <form method="GET" action="{{ route('customers.index') }}" class="grid grid-cols-4 gap-x-4 mt-2">
            <div>
                <label for="search" class="text-sm">{{ __('Search') }}</label>
                <input name="search" id="search" value="{{ request()->get('search') }}" type="text" class="input w-full" placeholder="{{ __('Search ...') }}">
            </div>
            <div>
                <label for="based-on" class="text-sm">{{ __('Based on') }}</label>
                <select name="based_on" id="based-on" class="input w-full">
                    <option @if(request()->get('based_on') === 'customer_email') selected @endif value="customer_email">{{ __('Customer email') }}</option>
                    <option @if(request()->get('based_on') === 'order_number') selected @endif value="order_number">{{ __('Order number') }}</option>
                    <option @if(request()->get('based_on') === 'item_name') selected @endif value="item_name">{{ __('Item name') }}</option>
                </select>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-indigo-100 text-indigo-800 px-6 py-2 rounded">{{ __('Search') }}</button>
                @if(request()->has('search'))
                    <a href="{{ route('customers.index') }}" type="submit" class="text-red-800 px-6 py-2 rounded">{{ __('Reset') }}</a>
                @endif
            </div>
        </form>
        <!-- / Search panel -->

        <!-- Customers list -->
        <div class="overflow-x-auto mt-4 bg-white rounded-xl border border-gray-300">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Name') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Email') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Addresses') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Total Orders') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($customers as $customer)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $customer['name'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $customer['email'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a target="_blank" href="#" class="text-indigo-600 font-bold">{{ count($customer['addresses']) }}</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a target="_blank" href="#" class="text-indigo-600 font-bold">{{ count($customer['orders']) }}</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a target="_blank" href="{{ route('customers.show', $customer['id']) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Details') }}</a>
                        </td>
                    </tr>
                @empty
                    <tr class="hover:bg-gray-100 transition">
                        <td colspan="5" class="px-6 py-4">{{ __('No customer was found.') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- / Customers list -->

        <!-- Pagination -->
        <div class="mt-4">
            {{ $customers->links() }}
        </div>
        <!-- / Pagination -->
    </div>
    <!-- / Customers -->
</x-layouts.app>
