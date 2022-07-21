<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        $carts = session()->get('cart', []);
        

        return view('cart', compact('carts'));
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function order()
    {
        $carts = session()->get('cart', []);
        $order_number = Auth::user()->id.''.Order::GetOrderNumber();
        foreach ($carts as $k => $book){
            $data=[
                'order_date'=>date("Y-m-d"),
                'order_number'=> $order_number,
                'status'=> 1,
                'type'=> "book",
                'reader_id'=> Auth::user()->id,
                'book_id'=> $k,
            ];
            $order = Order::create($data); 
        }

        session()->put('cart', []);
        toast(__('Your order has successfully accepted!'), 'success');
        return redirect()->route('myorders', [app()->getLocale(), 'id' => $order_number]);

        // return redirect()->back()->with('success', 'Your order has successfully accepted!');
    }

    
    public function myorders(Request $request)
    {
        $cur_user_id=Auth::user()->id;
        $order_number = trim($request->get('id'));
        if($order_number!=""){
            dd("VIEW ORDER DETAIL");
        }else{
            dd("ALL");
        }
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($language, $id, Request $request)
    {
        $type = trim($request->get('type'));
        $cart = session()->get('cart', []);
        if ($type == 'book') {
            $book = Book::findOrFail($id);

            if (!isset($cart[$id])) {
                $cart[$id] = [
                    "title" => $book->dc_title,
                    "book_id" => $id,
                    "quantity" => 1,
                    "type" => $type,
                    "price" => $book->price,
                    "image" => $book->image_path
                ];
            }
        }

        session()->put('cart', $cart);
        toast(__('Book added to cart successfully!'), 'success');
        return redirect()->back()->with('success', 'Book added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($language, Request $request)
    {

        if ($request->id) {
            $cart = session()->get('cart');
           
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            toast(__('Book removed from cart successfully!'), 'success');

            // session()->flash('success', 'Book removed successfully');
        }
    }
}
