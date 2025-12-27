<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageFeatureEnum;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use App\Services\SettingService;

class SettingController extends Controller
{
    public function __construct(protected SettingService $settingsService) {}

    public function index()
    {
        $pageFeatures = PageFeatureEnum::cases();
        return view('admin.settings.index', compact('pageFeatures'));
    }

    public function create() {}


    public function store(Request $request) {}


    public function show($id) {}


    public function edit($id) {}

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'string', 'max:255'],

            // colors
            'primary_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'secondary_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'background_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],

            // media
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg'],
            'logo_footer' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg'],
            'favicon' => ['nullable', 'image', 'mimes:png,jpg,jpeg,ico'],
        ]);

        // 🔹 store normal settings (text + colors)
        $this->storeSettings([
            'site_name',
            'primary_color',
            'secondary_color',
            'background_color',
        ], $request);

        // 🔹 store media settings
        $this->saveMediaSetting('logo', $request);
        $this->saveMediaSetting('logo_footer', $request);
        $this->saveMediaSetting('favicon', $request);

        // 🔹 FEATURE TOGGLES (Pennant)
        $this->syncFeatures($request->input('features', []));

        return back()->with('success', 'Settings updated successfully');
    }

    private function syncFeatures(array $features): void
    {
        foreach (PageFeatureEnum::cases() as $feature) {
            $enabled = array_key_exists($feature->value, $features);

            $feature->set($enabled);
        }
    }

    private function storeSettings(array $keys, Request $request): void
    {
        foreach ($keys as $key) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $request->input($key)]
            );
        }
    }

    private function saveMediaSetting(string $key, Request $request): void
    {
        if (! $request->hasFile($key)) {
            return;
        }

        $setting = Setting::firstOrCreate(['key' => $key]);

        $setting
            ->clearMediaCollection($key)
            ->addMedia($request->file($key))
            ->toMediaCollection($key);
    }


    // public function update(UpdateSettingsRequest $request)
    // {
    //     $res_update = $this->settingsService->update($request->validated());

    //     // set unchecked pages to 0
    //     $pages = ['page_home_enabled', 'page_about_enabled', 'page_contact_enabled'];
    //     foreach ($pages as $page) {
    //         $data[$page] = $request->has($page) ? 1 : 0;
    //     }

    //     if ($res_update['code'] == 0) {
    //         info($res_update['msg']);
    //         return redirect()
    //             ->back()
    //             ->with('error', 'Settings updated faild.');
    //     }

    //     return redirect()
    //         ->back()
    //         ->with('success', 'Settings updated successfully.');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {}
}
