<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = ['email'=>$request->email, 'order_number'=>$request->order_number, 'item_name'=>$request->item_name];
        $search=array_filter($search);
        $customers = Customer::search($search)->with(['orders' => function ($suborderQuery) use ($search) {
            if (isset($search['order_number'])) {
                $suborderQuery->where('order_number', 'like', "%{$search['order_number']}%");
            }
            if (isset($search['item_name'])) {
                $suborderQuery->whereHas('items', function ($Iquery) use ($search) {
                    $Iquery->where('name', 'like', "%{$search['item_name']}%");
                });
            }

            $suborderQuery->with('items');
        }])->paginate(15);

        return view('customer.index', compact('customers'));
    }
}
?>
