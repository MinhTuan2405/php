<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('course')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->course->price;
        });

        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Course $course)
    {
        Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
        ]);

        return redirect()->back()->with('success', 'Đã thêm khóa học vào giỏ hàng');
    }

    public function remove(Course $course)
    {
        Cart::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->delete();

        return redirect()->back()->with('success', 'Đã xóa khóa học khỏi giỏ hàng');
    }

    public function buy(Course $course)
    {

        Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
        ]);


        return redirect()->route('cart.index');
    }
}
