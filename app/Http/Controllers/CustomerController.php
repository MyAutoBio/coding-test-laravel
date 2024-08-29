<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * index function
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request):View
    {
        $customers = Customer::with(['orders.items']);

        // Check if there are any filters in the request
        $hasFilters = $this->hasFilters($request);

        if ($hasFilters) {
            $customers = $this->applyFilters($customers, $request);
        } else {
            $customers->whereHas('orders.items');
        }

        $customers = $customers->paginate($this->pagination);

        return view('customer.index', compact('customers'));
    }

    /**
     * Check if there are any filters in the request
     *
     * @param Request $request
     * @return bool
     */
    public function hasFilters(Request $request):bool
    {
        return $request->has('email') || $request->has('order') || $request->has('item');
    }

    /**
     * Apply filters to the customers query
     *
     * @param object $customers
     * @param Request $request
     * @return object
     */
    public function applyFilters($customers, Request $request):object
    {
        // Filter by email
        if ($request->has('email') && !empty($request->email)) {
            $customers->where('email', 'like', '%' . $request->email . '%');
        }

        // Filter by order number
        if ($request->has('order') && !empty($request->order)) {
            $customers->whereHas('orders', function ($query) use ($request) {
                $query->where('order_number', 'like', '%' . $request->order . '%');
            });
        }

        // Filter by item name
        if ($request->has('item') && !empty($request->item)) {
            $customers->whereHas('orders.items.item', function ($query) use ($request) {
                // FULL match query to match exact item
                $query->whereRaw('MATCH(name) AGAINST (?)', [$request->item]);
            });
        }

        return $customers;
    }
}
