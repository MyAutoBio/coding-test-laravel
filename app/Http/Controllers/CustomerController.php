<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search','');

        // build query with search functionality and eager loading

        $query = Customer::search($search)
            ->with('orders.items');

        // paginate the results to handle large datasets

        $customers = $query->paginate(10);

        return view('customer.index',compact('customers'));

    }
}
