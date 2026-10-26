<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CatalogFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string', 'max:100'],
            'category' => [
                'nullable',
                'string',
                Rule::exists('categories', 'name'),
            ],
            'operation' => [
                'nullable',
                Rule::in(Product::OPERATIONS),
            ],
            'sort' => [
                'nullable',
                Rule::in(['newest', 'price_asc', 'price_desc']),
            ],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => [
                'nullable',
                Rule::in([9, 12, 24]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'q.max' => 'Пошуковий запит не може перевищувати 100 символів.',
            'category.exists' => 'Такої категорії не існує.',
            'operation.in' => 'Недопустимий тип операції.',
            'sort.in' => 'Недопустимий спосіб сортування.',
            'page.integer' => 'Номер сторінки має бути цілим числом.',
            'page.min' => 'Номер сторінки має бути не меншим за 1.',
            'per_page.in' => 'Дозволено 9, 12 або 24 товари на сторінку.',
        ];
    }
}
