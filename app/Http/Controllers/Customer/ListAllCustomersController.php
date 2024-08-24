<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Validation\Rule;

class ListAllCustomersController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'search' => ['sometimes', 'string'],
            'based_on' => ['sometimes', 'in:customer_email,order_number,item_name'],
        ]);

        $customers = Customer::query();

        if ($request->get('search') && $request->has('based_on')) {
            $search = $request->get('search');

            $customers = $this->filterRecords($customers, $search);
        }

        $customers = $customers->with('addresses', 'orders.items')
            ->paginate();

        return view('customers.index', compact('customers'));
    }

    private function filterRecords($customers, $search)
    {
        switch(request()->get('based_on')) {
            case 'customer_email':
                $customers->where('email', $search);
                break;
            case 'order_number':
                $customers->whereHas('orders', function ($query) use ($search) {
                    return $query->where('reference', 'LIKE', "%$search%");
                });
                break;
            case 'item_name':
                $customers->whereHas('orders.items', function ($query) use ($search) {
                    return $query->where('item', 'LIKE', "%$search%");
                });
                break;
        }

        return $customers;
    }
}
