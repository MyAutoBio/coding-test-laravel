<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;

class ListAllCustomersController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'search' => ['sometimes', 'string'],
//            'based_on' => ['sometimes', 'in:customer_email,order_number,item_name'],
        ]);

        $search = $request->get('search');
        $output = collect([]);

        // Eager load necessary relationships and chunk results into parts of 1000 records
        Customer::with(['addresses', 'orders.items'])->chunk(1000, function ($users) use ($request, &$output) {
            if ($request->get('search') && $request->has('based_on')) {
                $search = $request->get('search');

                $output = $output->merge($this->filterRecords($users, $search)->values());
            } else {
                $output = $output->merge($users);
            }
        });

        $customers = $this->paginateResults($output);

        return view('customers.index', compact('customers'));
    }

    private function filterRecords($customers, $search)
    {
        return $customers->filter(function ($customer) use ($search) {
            switch (request()->get('based_on')) {
                case 'customer_email':
                    return stripos($customer->email, $search) !== false;
                case 'order_number':
                    return $customer->orders->contains(function ($order) use ($search) {
                        return stripos($order->reference, $search) !== false;
                    });
                case 'item_name':
                    return $customer->orders->flatMap->items->contains(function ($item) use ($search) {
                        return stripos($item->item, $search) !== false;
                    });
                default:
                    return false;
            }
        });
    }

    private function paginateResults($output)
    {
        $page = request()->input('page', 1);
        $perPage = 10;
        $total = $output->count();

        return new LengthAwarePaginator(
            $output->forPage($page, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
