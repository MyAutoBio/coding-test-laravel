<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Contracts\View\View;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(): View
    {
        return view('customer.index');
    }
    public function getData()
    {

        $query = Order::select(['orders.id', 'orders.total_amount', 'customers.name', 'orders.customer_id'])
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('item_purchaseds', 'item_purchaseds.order_id', '=', 'orders.id')
            ->groupBy('orders.id');



        return DataTables::of($query)
            ->addColumn('customer_name', function ($order) {
                return $order->customer->name;
            })
            ->addColumn('items', function ($order) {

                $items = [];
                foreach ($order->itemPurchased as $item) {
                    $items[] = $item->item->name;
                }
                return $items;
            })
            ->make(true);
    }
}
