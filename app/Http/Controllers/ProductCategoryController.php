<?php

namespace App\Http\Controllers;

use App\Enums\IsActiveEnum;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::with('image')->paginate(env("NUMBER_ITEMS_PER_PAGE"));
        return inertia("ProductCategories/Index", ["product_categories" => $product_categories]);
    }

    public function create()
    {
        $is_active_ops = IsActiveEnum::cases();
        return Inertia("ProductCategories/Create", ["is_active_ops" => $is_active_ops]);
    }

    public function store(ProductCategoryRequest $request)
    {
        $file_name = null;
        $file_url = null;

        if ($request->file("fileName")) {

            $url = Storage::disk('google')->put("product-categories", $request->file("fileName"));
            $file_name = str_replace("product-categories/", "", $url);
            $public_link = Storage::disk('google')->url("product-categories/" . $file_name);

            $file_url = str_replace(
                "https://drive.google.com/uc",
                "https://drive.google.com/thumbnail",
                $public_link
            );
        }

        $productCategory = ProductCategory::create(
            [
                'name' => $request->name,
                "image_name" => $file_name,
                'is_active' => $request->is_active,
            ]
        );

        if ($file_name) {
            $productCategory->image()->create(["url" => $file_url]);
        }

        return redirect()->route("product-categories.index");
    }

    public function show(ProductCategory $productCategory)
    {
        //
    }

    public function edit(ProductCategory $productCategory)
    {
        $is_active_ops = IsActiveEnum::cases();
        return inertia("ProductCategories/Edit", ["product_category" => ProductCategory::with('image')->find($productCategory->id), "is_active_ops" => $is_active_ops]);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $file_name = null;
        $file_url = null;
        $is_new_image = false;

        if ($request->file("fileName")) {
            if ($request->get("prev_image")) {

                Storage::disk('google')->delete("product-categories/" . $request->image_name);

                $url = Storage::disk('google')->put("product-categories", $request->file("fileName"));
                $file_name = str_replace("product-categories/", "", $url);
                $public_link = Storage::disk('google')->url("product-categories/" . $file_name);

                $file_url = str_replace(
                    "https://drive.google.com/uc",
                    "https://drive.google.com/thumbnail",
                    $public_link
                );
            } else {
                $url = Storage::disk('google')->put("product-categories", $request->file("fileName"));
                $file_name = str_replace("product-categories/", "", $url);
                $public_link = Storage::disk('google')->url("product-categories/" . $file_name);

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
                    Storage::disk('google')->delete("product-categories/" . $request->image_name);
                    $productCategory->image()->delete(["url" => $request->image_name]);
                }
            }
        }

        $productCategory->update(
            [
                'name' => $request->name,
                "image_name" => $file_name,
                'is_active' => $request->is_active,
            ]
        );

        if ($file_name) {
            if ($is_new_image) {
                $productCategory->image()->create(["url" => $file_url]);
            } else {
                $productCategory->image()->update(["url" => $file_url]);
            }
        }

        return redirect()->route("product-categories.index");
    }

    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->image_name) {
            Storage::disk('google')->delete("product-categories/" . $productCategory->image_name);
            $productCategory->image()->delete(["url" => $productCategory->image_name]);
        }
        $productCategory->delete();

        return redirect()->route("product-categories.index");
    }
}
