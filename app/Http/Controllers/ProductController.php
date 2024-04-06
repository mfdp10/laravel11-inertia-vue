<?php

namespace App\Http\Controllers;

use App\Enums\IsActiveEnum;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('pictures')->with("product_categories")->paginate(env("NUMBER_ITEMS_PER_PAGE"));
        //dump($products);
        return inertia("Products/Index", ["products" => $products]);
    }

    public function create()
    {
        $is_active_ops = IsActiveEnum::cases();
        $product_categories_ops = ProductCategory::all();
        return Inertia("Products/Create", ["is_active_ops" => $is_active_ops, "product_categories_ops" => $product_categories_ops]);
    }

    public function store(ProductRequest $request)
    {
        //dd($request);
        $file_name = null;
        $file_url = null;

        if ($request->file("fileName")) {

            $url = Storage::disk('google')->put("products", $request->file("fileName"));
            $file_name = str_replace("products/", "", $url);
            $public_link = Storage::disk('google')->url("products/" . $file_name);

            $file_url = str_replace(
                "https://drive.google.com/uc",
                "https://drive.google.com/thumbnail",
                $public_link
            );
        }

        $product = Product::create($request->validated());
        $product->product_categories()->sync($request->product_categories);

        if ($file_name) {
            $product->pictures()->create(["url" => $file_url, "image_name" => $file_name]);
        }

        return redirect()->route("products.index");
    }

    public function show(Product $product)
    {
        return Inertia("Products/Show", ["product" => Product::with('pictures')->with("product_categories")->find($product->id)]);
    }

    public function edit(Product $product)
    {
        $is_active_ops = IsActiveEnum::cases();
        $product_categories_ops = ProductCategory::all();
        $saved_product_categories = DB::table('product_product_category')
            ->select('product_category_id')
            ->where('product_id', '=', $product->id)
            ->get()
            ->pluck('product_category_id')
            ->toArray();

        return inertia("Products/Edit", ["product" => Product::with('pictures')->with("product_categories")->find($product->id), "is_active_ops" => $is_active_ops, "product_categories_ops" => $product_categories_ops, "saved_product_categories" => $saved_product_categories]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $file_name = null;
        $file_url = null;
        $is_new_image = false;

        if ($request->file("fileName")) {
            if ($request->get("prev_image")) {

                Storage::disk('google')->delete("products/" . $request->image_name);

                $url = Storage::disk('google')->put("products", $request->file("fileName"));
                $file_name = str_replace("products/", "", $url);
                $public_link = Storage::disk('google')->url("products/" . $file_name);

                $file_url = str_replace(
                    "https://drive.google.com/uc",
                    "https://drive.google.com/thumbnail",
                    $public_link
                );
            } else {
                $url = Storage::disk('google')->put("products", $request->file("fileName"));
                $file_name = str_replace("products/", "", $url);
                $public_link = Storage::disk('google')->url("products/" . $file_name);

                $file_url = str_replace(
                    "https://drive.google.com/uc",
                    "https://drive.google.com/thumbnail",
                    $public_link
                );
                $is_new_image = true;
            }
        } else {
            if (!$request->get("filePreview")) { //delete existing image
                if ($request->get("prev_image")) {
                    Storage::disk('google')->delete("products/" . $request->image_name);
                    $product->image()->delete(["url" => $request->image_name]);
                }
            }
        }

        $product->update($request->validated());
        $product->product_categories()->sync($request->product_categories);


        if ($file_name) {
            if ($is_new_image) {
                $product->pictures()->create(["url" => $file_url, "image_name" => $file_name]);
            } else {
                $product->pictures()->update(["url" => $file_url, "image_name" => $file_name]);
            }
        }

        return redirect()->route("products.index");
    }

    public function destroy(Product $product)
    {
        if ($product->image_name) {
            Storage::disk('google')->delete("products/" . $product->image_name);
            $product->pictures()->delete(["url" => $product->image_name]);
        }
        $product->delete();

        return redirect()->route("products.index");
    }
}
