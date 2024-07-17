<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function orderpage()
    {
        return view('dashboard.pages.orders');
    }
    public function checkout()
    {
        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        // Group cart items by store_id
        $storeCartItems = $cartItems->groupBy('product.store_id');

        DB::beginTransaction();

        try {
            foreach ($storeCartItems as $storeId => $items) {
                $grandTotal = 0;

                foreach ($items as $item) {
                    $grandTotal += $item->product->price * $item->quantity;
                }

                // Create order for each store
                $order = Order::create([
                    'user_id' => $userId,
                    'store_id' => $storeId,
                    'grand_total' => $grandTotal,
                    'status' => 'Pending'
                ]);

                // Create order items for the order
                foreach ($items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'total_price' => $item->product->price * $item->quantity
                    ]);
                }
            }

            // Clear the cart for the user
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return response()->json(['message' => 'Order placed successfully']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Error placing order', 'error' => $e->getMessage()], 500);
        }
    }
    public function getOrders()
    {
        $store_id = Auth::user()->store->id;
        $orders = Order::with('user')->where('store_id', $store_id)->get();

        return DataTables::of($orders)
            ->addColumn('action', function ($order) {
                $approveUrl = route('orders.approve', $order->id);
                $rejectUrl = route('orders.reject', $order->id);

                $actions = '<a href="' . route('order.items', $order->id) . '" class="btn btn-primary btn-sm">View Items</a>';

                if ($order->status == 'Pending') {
                    $actions .= '<a href="'.$approveUrl.'" class="btn btn-success btn-sm">Approve</a>';
                    $actions .= '<a href="'.$rejectUrl.'" class="btn btn-danger btn-sm">Reject</a>';
                }

                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);

    }
    public function getOrderItems($id)
    {
        $orderItems = OrderItem::where('order_id',$id)->with('product')->get();

        // foreach($orderItems as $items){
        //     dd($items->product->name);
        // }

        return view('dashboard.pages.orderItems', compact('orderItems'));
    }

    public function approveOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Approved']);

        // Any additional logic related to approving the order

        return redirect()->back()->with('success', 'Order approved successfully.');
    }

    public function rejectOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Rejected']);

        // Any additional logic related to rejecting the order

        return redirect()->back()->with('success', 'Order rejected successfully.');
    }

}
