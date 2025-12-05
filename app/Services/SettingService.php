<?php

namespace App\Services;

use App\Models\Setting;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SettingService
{
    public function update(array $data)
    {
        try 
        {
            foreach ($data as $key => $value) {

                // handle file uploads
                if ($value instanceof UploadedFile) {
                    $value = $value->store('settings', 'public');
                }
    
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            return ['code' => 1, 'data' => true];
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}
