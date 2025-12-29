<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Set to true if you want all users to be able to submit this form.
        // For more complex logic, return a boolean based on user permissions.
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
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'title' => 'required',
            'content' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date']
        ];
    }
}
