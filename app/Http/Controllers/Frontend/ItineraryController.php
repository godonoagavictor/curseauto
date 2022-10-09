<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Itinerary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;

class ItineraryController extends Controller
{
    public function itinerary(Itinerary $itinerary)
    {
        return view('frontend.itinerary', compact('itinerary'));
    }

    public function store(Request $request)
    {
        $twoWay = !isset($request->two_way) ? false : true;

        $request->validate([
            'count' => 'required|numeric'
        ]);

        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'two_way' => $twoWay,
            'itinerary_id' => $request->itinerary_id,
            'count' => $request->count,
        ]);


        Notification::route('mail', [
            'garaautomd@gmail.com' => 'Gara Auto',
        ])->notify(new OrderNotification($order));


        if ($order->wasRecentlyCreated) {
            return redirect()->back()->with(['toast' => ['message' => __('Message has been sent with success')]]);;
        } else {
            return redirect()->back()->with(['toast' => ['error' => __('Message has not been sent')]]);;
        }
    }
}
