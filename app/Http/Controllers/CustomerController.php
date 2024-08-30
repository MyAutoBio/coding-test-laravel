<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function userDetail()
    {

        $customers = Customer::with('orders.orderedItems')->paginate(10);

        return view('customers', compact('customers'));
    }

    public function userSearch(Request $request)
    {
        $searchTerm = $request->input('search');

        $customers = Customer::with('orders.orderedItems')
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('email', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('orders', function ($query) use ($searchTerm) {
                        $query->where('order_number', 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('orders.orderedItems.item', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    });
            })
            ->paginate(10);

        return view('customers', compact('customers'));
    }
}
