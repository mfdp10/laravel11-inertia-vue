<?php

namespace App\Http\Requests;

use App\Enums\IsActiveEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProductCategoryRequest extends FormRequest
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
            "name"      => ["required", "string", "max:100", Rule::unique(table: "product_categories", column: "name")->ignore(id: request("product_category"), idColumn: "id")],
            'is_active' => ['required', new Enum(IsActiveEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            "name.unique" => __("product_category_exists")
        ];
    }
}
