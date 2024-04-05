<?php

namespace App\Http\Controllers;

use App\Enums\IsActiveEnum;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
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
        $file_name = null;
        $file_url = null;

        if ($request->file("fileName")) {

            $url = Storage::disk('google')->put("customers", $request->file("fileName"));
            $file_name = str_replace("customers/", "", $url);
            $public_link = Storage::disk('google')->url("customers/" . $file_name);

            $file_url = str_replace(
                "https://drive.google.com/uc",
                "https://drive.google.com/thumbnail",
                $public_link
            );
        }

        $customer = Customer::create(
            [
                "first_name" => $request->first_name,
                "last_name"  => $request->last_name,
                "company"    => $request->company,
                "phone"      => $request->phone,
                "mobile"     => $request->mobile,
                "id_card"    => $request->id_card,
                "email"      => $request->email,
                "comments"   => $request->comments,
                "image_name" => $file_name,
                'is_active'  => $request->is_active,
            ]
        );

        if ($file_name) {
            $customer->image()->create(["url" => $file_url]);
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
        $file_name = null;
        $file_url = null;
        $is_new_image = false;

        if ($request->file("fileName")) {
            if ($request->get("prev_image")) {

                Storage::disk('google')->delete("customers/" . $request->image_name);

                $url = Storage::disk('google')->put("customers", $request->file("fileName"));
                $file_name = str_replace("customers/", "", $url);
                $public_link = Storage::disk('google')->url("customers/" . $file_name);

                $file_url = str_replace(
                    "https://drive.google.com/uc",
                    "https://drive.google.com/thumbnail",
                    $public_link
                );
            } else {
                $url = Storage::disk('google')->put("customers", $request->file("fileName"));
                $file_name = str_replace("customers/", "", $url);
                $public_link = Storage::disk('google')->url("customers/" . $file_name);

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
                    Storage::disk('google')->delete("customers/" . $request->image_name);
                    $customer->image()->delete(["url" => $request->image_name]);
                }
            }
        }

        $customer->update(
            [
                "first_name" => $request->first_name,
                "last_name"  => $request->last_name,
                "company"    => $request->company,
                "phone"      => $request->phone,
                "mobile"     => $request->mobile,
                "id_card"    => $request->id_card,
                "email"      => $request->email,
                "comments"   => $request->comments,
                "image_name" => $file_name,
                'is_active'  => $request->is_active,
            ]
        );

        if ($file_name) {
            if ($is_new_image) {
                $customer->image()->create(["url" => $file_url]);
            } else {
                $customer->image()->update(["url" => $file_url]);
            }
        }

        return redirect()->route("customers.index");
    }

    public function destroy(Customer $customer)
    {
        if ($customer->image_name) {
            Storage::disk('google')->delete("customers/" . $customer->image_name);
            $customer->image()->delete(["url" => $customer->image_name]);
        }
        $customer->delete();

        return redirect()->route("customers.index");
    }
}
