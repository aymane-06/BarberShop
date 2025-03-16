<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorebarberShopRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:barber_shops',
            'description' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'barbers' => 'required|array',
            'avatar' => 'nullable|image',
            'cover' => 'nullable|image',
            'slug' => 'required|string|unique:barber_shops',
            'website' => 'nullable|string',
            'social_links' => 'nullable|array',
            'working_hours' => 'required|array',
            'views' => 'integer',
            'bookings' => 'integer',
            'reviews' => 'integer',
            'ratings_count' => 'integer',
            'ratings' => 'numeric',
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
            'verified_at' => 'nullable|date',
        ];
    }
}
