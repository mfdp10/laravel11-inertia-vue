<?php

namespace App\Http\Controllers;

use App\Enums\IsActiveEnum;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('image')->paginate(env("NUMBER_ITEMS_PER_PAGE"));
        return inertia("Customers/Index", ["customers" => $customers]);
    }

    public function create()
    {
        $is_active_ops = IsActiveEnum::cases();
        return Inertia("Customers/Create", ["is_active_ops" => $is_active_ops]);
    }

    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->validated());

        if ($request->file("fileName")) {
            $url = Storage::disk('public')->put("customers", $request->file("fileName"));

            $customer->image()->create(["url" => $url]);
        }

        return redirect()->route("customers.index");
    }

    public function show(Customer $customer)
    {
        return Inertia("Customers/Show", ["customer" => Customer::with('image')->find($customer->id)]);
    }

    public function edit(Customer $customer)
    {
        $is_active_ops = IsActiveEnum::cases();
        return inertia("Customers/Edit", ["customer" => Customer::with('image')->find($customer->id), "is_active_ops" => $is_active_ops]);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        //dd($request);
        $customer->update($request->validated());

        if ($request->file("fileName")) {
            if ($request->get("prev_image")) {
                $old_image = str_replace("/storage", "", $request->get("prev_image"));
                Storage::disk('public')->delete($old_image);
                $url = Storage::disk('public')->put("customers", $request->file("fileName"));
                $customer->image()->update(["url" => $url]);
            } else {
                $url = Storage::disk('public')->put("customers", $request->file("fileName"));
                $customer->image()->create(["url" => $url]);
            }
        } else {
            if (!$request->get("filePreview")) { //delete existing image
                if ($request->get("prev_image")) {
                    $old_image = str_replace("/storage", "", $request->get("prev_image"));
                    Storage::disk('public')->delete($old_image);
                    $customer->image()->delete(["url" => $request->get("prev_image")]);
                }
            }
        }
        return redirect()->route("customers.index");
    }

    public function destroy(Customer $customer)
    {
        $img = Customer::with('image')->find($customer->id);
        if ($img->image) {
            Storage::disk('public')->delete($img->image->url);
            $customer->image()->delete(["url" => $img->image->url]);
        }
        $customer->delete();

        return redirect()->route("customers.index");
    }
}
