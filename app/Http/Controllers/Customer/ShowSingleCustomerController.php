<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class ShowSingleCustomerController extends Controller
{
    public function __invoke(Customer $customer)
    {
        $customer->load('addresses', 'orders.items');

        return view('customers.show', compact('customer'));
    }
}
