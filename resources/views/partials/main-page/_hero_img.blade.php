@use(App\Enums\PageFeatureEnum)

@if($heroMedia && PageFeatureEnum::HOME_HERO_IMG->is_enabled())
<div class="top-img w-100">
    <img src="{{ $heroMedia->getUrl() }}" 
         alt="Hero Image" 
         class="w-100">
</div>
@endif