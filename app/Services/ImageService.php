<?php

namespace App\Services;

use App\Models\Setting;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Throwable;

class ImageService
{
    public function upload(array $data): array
    {
        try {
            // Generate unique name
            $imageName = '_image' . time() . '.' . $data['image']->getClientOriginalExtension();

            // Store
            $path = $data['image']->storeAs('images', $imageName, 'public');

            $image = Image::create([
                'name'        => $path,
                'category_id' => $data['category'],
            ]);


            return ['code' => 1, 'data' => $image];
        } catch (Throwable $th) {

            return ['code' => 0, 'msg' => $th->getMessage()];
        }
    }


    public function remove(array $data): array
    {
        try {
            $image = Image::findOrFail($data['id']);

            if (Storage::disk('public')->exists($image->name)) {
                Storage::disk('public')->delete($image->name);
            }

            $image->delete();

            return ['code' => 1, 'data' => true];
        } catch (Throwable $th) {

            return ['code' => 0, 'msg' => $th->getMessage()];
        }
    }
}
