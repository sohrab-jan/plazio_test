<?php

namespace App\Http\Controllers;

use App\Http\Requests\Carts\AddToCartRequest;
use App\Http\Requests\Carts\ChangeCartItemCountRequest;
use App\Http\Resources\CartItemResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    use ApiResponder;

    /**
     * @param  AddToCartRequest  $request
     * @return JsonResponse
     */
    public function addToCart(AddToCartRequest $request): JsonResponse
    {
        $userId = User::first()->id ?? 1; //todo add authenticated user

        $cart = Cart::whereUserId($userId)->first();

        if ($cart == null){
            $cart = Cart::create([
                'user_id'=> $userId,
                'status' => true
            ]);
        }
        $quantity = $request->quantity;
        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $quantity){
            return $this->errorResponse(__('errors.stock_is_not_enough'), 422);
        }

        $cartItem = CartItem::create([
            'product_id' => $product->id,
            'cart_id'    => $cart->id,
            'quantity'   => $quantity
        ]);
        $cartItemResource = new CartItemResource($cartItem);

        return $this->successResponse($cartItemResource);
    }

    /**
     * @param  ChangeCartItemCountRequest  $request
     * @return JsonResponse
     */
    public function changeCartItemCount(ChangeCartItemCountRequest $request): JsonResponse
    {
        $cartItem = CartItem::with('product')->findOrFail($request->cart_item_id);
        $cartItem->update([
            'quantity' => $request->quantity
        ]);
        $cartItemResource = new CartItemResource($cartItem);

        return $this->successResponse($cartItemResource);
    }
}
