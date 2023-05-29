<?php

namespace App\Http\Controllers\Travel\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\Offer\StoreOfferRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class UpdateOfferController extends Controller
{
    public function updateOffer(Order $order, StoreOfferRequest $request) {
        $validated = $request->validated();
        if ($validated) {
            $validated['user_id'] = auth()->id();
            $validated['order_id'] = $order->id;
            $order->offers()
                ->where('user_id', auth()->id())
                ->where('order_id', $order->id)
                ->update($validated);
            return response()->json(["status" => true]);
        } else {
            return response()->json([
                'error' => $validated->errors()
            ], 422);
        }
    }
}
