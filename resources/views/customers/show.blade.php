<x-layouts.app>
    <div class="px-10 py-10">
        <div class="grid grid-cols-5">
            <div class="col-span-1">
                <p class="text-2xl sticky text-black font-bold">Addresses ({{ $customer->addresses->count() }})</p>
                <p class="text-gray-400 sticky-under text-sm">{{ __('All the user\'s addresses') }}</p>
            </div>
            <div class="col-span-4 bg-white rounded shadow-sm p-5 my-auto">
                @forelse($customer->addresses as $address)
                    <div class="">
                        <div>
                            <x-partials.status color="blue" :label="$address->type->label()" />
                            <div class="grid grid-cols-4 mt-2">
                                <div>
                                    <p>{{ __('City') }}</p>
                                    <p class="text-black text-sm">{{ $address->city }}</p>
                                </div>
                                <div>
                                    <p>{{ __('Region') }}</p>
                                    <p class="text-black text-sm">{{ ucfirst($address->region) }}</p>
                                </div>
                                <div>
                                    <p>{{ __('Street') }}</p>
                                    <p class="text-black text-sm">{{ $address->street }}</p>
                                </div>
                                <div>
                                    <p>{{ __('Zip code') }}</p>
                                    <p class="text-black text-sm">{{ $address->zip_code }}</p>
                                </div>
                                <div class="col-span-4 mt-2">
                                    <p>{{ __('Full address') }}</p>
                                    <p class="text-black text-sm">{{ $address->full_address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <div class="border-b border-b-gray-200 my-4"></div>
                    @endif
                @empty
                    <p class="text-gray-400">{{ __('This user doesn\'t have any address.') }}</p>
                @endforelse
            </div>
        </div>

        <div class="grid grid-cols-5 mt-16">
            <div class="col-span-1">
                <p class="text-2xl sticky text-black font-bold">Orders ({{ $customer->orders->count() }})</p>
                <p class="text-gray-400 sticky-under text-sm">{{ __('All the user\'s orders') }}</p>
            </div>
            <div class="col-span-4 bg-white rounded shadow-sm p-5 my-auto">
                @forelse($customer->orders as $order)
                    <div>
                        <x-partials.status :color="$order->status->color()" :label="$order->status->label()" />
                        <div class="grid grid-cols-4 mt-2">
                            <div>
                                <p>{{ __('Reference') }}</p>
                                <p class="text-black text-sm">{{ $order->reference }}</p>
                            </div>
                            <div>
                                <p>{{ __('Total') }}</p>
                                <p class="text-black text-sm">${{ $order->total }}</p>
                            </div>
                            <div>
                                <p>{{ __('Note') }}</p>
                                <p class="text-black text-sm">{{ $order->note ?? '–' }}</p>
                            </div>
                            <div class="col-span-4 mt-5">
                                <p>{{ __('Items') .  ' (' . count($order->items) . ')' }}</p>
                            </div>
                            <div class="col-span-4 bg-gray-100 rounded border mt-3 p-5">
                                @if($order->items)
                                    <div class="grid grid-cols-5">
                                        <div class="col-span-2">
                                            <p>{{ __('Item') }}</p>
                                        </div>
                                        <div class="col-span-1">
                                            <p>{{ __('Price') }}</p>
                                        </div>
                                        <div class="col-span-1">
                                            <p>{{ __('Quantity') }}</p>
                                        </div>
                                    </div>
                                    @forelse($order->items as $item)
                                        <div class="grid grid-cols-5">
                                            <div class="col-span-2">
                                                <p class="text-black text-sm">{{ $item->item }}</p>
                                            </div>
                                            <div class="col-span-1">
                                                <p class="text-black text-sm">${{ $item->price }}</p>
                                            </div>
                                            <div class="col-span-1">
                                                <p class="text-black text-sm">{{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-400">{{ __('This order doesn\'t have any items.') }}</p>
                                    @endforelse
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <div class="border-b border-b-gray-200 my-4"></div>
                    @endif
                @empty
                    <p class="text-gray-400">{{ __('This user hasn\'t placed any order.') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
