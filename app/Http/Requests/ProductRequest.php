<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'slug' => 'string|max:200',
            'tags'  => 'array',
            'abstract' => 'string|max:500',
            'content' => 'string|max:1000',
            'category_id' => 'integer',
            'price' => 'required|numeric',
            'quantity' => 'integer',
            'status' => 'in:opened,closed',
            'published_at' => 'date_format:d/m/Y H:i:s'
        ];
    }
}
