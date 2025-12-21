@php
    $mapSetting = App\Models\MapSetting::first();
@endphp

@if($mapSetting && $mapSetting->is_active)
<div class="container px-0 mb-4">
    <iframe style="border:0; width: 100%; height: {{ $mapSetting->height }}px;"
          src="{{ $mapSetting->embed_url }}"
          frameborder="0"
          allowfullscreen
          loading="lazy"></iframe>
</div>
@endif