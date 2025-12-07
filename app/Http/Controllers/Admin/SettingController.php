<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.settings.index');
    }

    public function create() {}


    public function store(Request $request) {}


    public function show($id) {}


    public function edit($id) {}

    public function update(UpdateSettingsRequest $request)
    {
        $res_update = $this->settingsService->update($request->validated());

        // set unchecked pages to 0
        $pages = ['page_home_enabled', 'page_about_enabled', 'page_contact_enabled'];
        foreach ($pages as $page) {
            $data[$page] = $request->has($page) ? 1 : 0;
        }

        if ($res_update['code'] == 0) {
            info($res_update['msg']);
            return redirect()
                ->back()
                ->with('error', 'Settings updated faild.');
        }

        return redirect()
            ->back()
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {}
    
}
