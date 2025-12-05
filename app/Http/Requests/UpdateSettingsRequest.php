<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow admin only (middleware handles this)
    }

    public function rules(): array
    {
        return [
            'site_name'       => ['nullable', 'string', 'max:255'],

            'logo'            => ['nullable', 'image', 'max:2048'],
            'logo_footer'       => ['nullable', 'image', 'max:2048'],
            'favicon'         => ['nullable', 'image', 'max:1024'],

            'primary_color'   => ['nullable', 'string'],
            'secondary_color' => ['nullable', 'string'],
            'background_color' => ['nullable', 'string'],

            'page_home_enabled' => 'nullable|in:0,1',
            'page_about_enabled' => 'nullable|in:0,1',
            'page_contact_enabled' => 'nullable|in:0,1',

        ];
    }
}
