<?php

namespace App\Http\Controllers;

use App\Enums\IsActiveEnum;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
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
        $productCategory = ProductCategory::create($request->validated());

        if ($request->file("fileName")) {
            $url = Storage::disk('public')->put("product-categories", $request->file("fileName"));

            $productCategory->image()->create(["url" => $url]);
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
        $productCategory->update($request->validated());

        if ($request->file("fileName")) {
            if ($request->get("prev_image")) {
                $old_image = str_replace("/storage", "", $request->get("prev_image"));
                Storage::disk('public')->delete($old_image);
                $url = Storage::disk('public')->put("product-categories", $request->file("fileName"));
                $productCategory->image()->update(["url" => $url]);
            } else {
                $url = Storage::disk('public')->put("product-categories", $request->file("fileName"));
                $productCategory->image()->create(["url" => $url]);
            }
        } else {
            if (!$request->get("filePreview")) { //delete existing image
                if ($request->get("prev_image")) {
                    $old_image = str_replace("/storage", "", $request->get("prev_image"));
                    Storage::disk('public')->delete($old_image);
                    $productCategory->image()->delete(["url" => $request->get("prev_image")]);
                }
            }
        }
        return redirect()->route("product-categories.index");
    }

    public function destroy(ProductCategory $productCategory)
    {
        $img = ProductCategory::with('image')->find($productCategory->id);
        if ($img->image) {
            Storage::disk('public')->delete($img->image->url);
            $productCategory->image()->delete(["url" => $img->image->url]);
        }
        $productCategory->delete();

        return redirect()->route("product-categories.index");
    }
}
