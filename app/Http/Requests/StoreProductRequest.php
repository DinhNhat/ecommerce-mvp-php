<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The route that users should be redirected to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'admin.products.create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'priceInCents' => ['required', 'integer', 'min:1'],
            'file' => ['required', 'file'],
            'image' => ['required', 'image'], // Validate that an uploaded file is exactly 400 kilobytes...
            'imageSave' => ['nullable', 'string']
        ];
    }

    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
public function messages(): array
{
    return [
        'file.required' => 'A file needs uploading',
        'image.required' => 'An image is missing',
    ];
}
}
