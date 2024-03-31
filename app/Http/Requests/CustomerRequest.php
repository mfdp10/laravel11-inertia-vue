<?php

namespace App\Http\Requests;

use App\Enums\IsActiveEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => ["required", "string", "max:50"],
            "last_name"  => ["required", "string", "max:50"],
            "company"    => ["nullable", "string", "max:150"],
            "phone"      => ["nullable", "string", "max:30"],
            "mobile"     => ["nullable", "string", "max:30"],
            "id_card"    => ["nullable", "string", "max:10"],
            "email"      => ["required", "email", "max:80", Rule::unique(table: "customers", column: "email")->ignore(id: request("customer"), idColumn: "id")],
            "comments"    => ["nullable", "string", "max:255"],
            'is_active'  => ['required', new Enum(IsActiveEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            "email.unique" => __("email_exists")
        ];
    }
}
