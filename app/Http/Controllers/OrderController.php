<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
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
}
