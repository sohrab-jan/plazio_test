<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Storage;

class ProductController extends Controller
{
    use ApiResponder;

    public function getProductList(): JsonResponse
    {
        $products = Product::latest()->get();
        $productsResource = ProductResource::collection($products);

        return $this->successResponse($productsResource);
    }

    /**
     * @param  StoreProductRequest  $request
     * @return JsonResponse
     */
    public function storeProduct(StoreProductRequest $request): JsonResponse
    {
        if ( $request->hasFile('image')){
            $image = $request->file('image');
            $imagePath = $this->uploadImage($image);
        }

        $product = Product::create([
            'name'  => $request->name,
            'image' => $imagePath,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        $productResource =new ProductResource($product);

        return $this->successResponse($productResource,201);
    }

    /**
     * @param  Product  $product
     * @return JsonResponse
     */
    public function productDetails(Product $product): JsonResponse
    {
        $productResource = new ProductResource($product);

        return $this->successResponse($productResource);
    }

    /**
     * @param  Product  $product
     * @param  UpdateProductRequest  $request
     * @return JsonResponse
     */
    public function updateProduct(Product $product,UpdateProductRequest $request): JsonResponse
    {
        if ( $request->hasFile('image')){
            $image = $request->file('image');
            $imagePath = $this->uploadImage($image);
            $oldImage = $product->image;
            Storage::disk('public')->delete($oldImage);
        }

        $product->update([
            'name'  => $request->name,
            'image' => $imagePath ?? $product->image,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        $productResource = new ProductResource($product);

        return $this->successResponse($productResource);
    }

    /**
     * @param  Product  $product
     * @return JsonResponse
     */
    public function deleteProduct(Product $product): JsonResponse
    {
        if (isset($product->image)){
            $oldImage = $product->image;
            Storage::disk('public')->delete($oldImage);
        }

        $product->delete();

        return $this->successResponse([]);
    }


    /**
     * @param  UploadedFile  $image
     * @return false|string
     */
    private function uploadImage(UploadedFile $image)
    {
        $imageName = time().'.'.$image->getClientOriginalExtension();
        return $image->storeAs('images/products',$imageName,'public');
    }
}
