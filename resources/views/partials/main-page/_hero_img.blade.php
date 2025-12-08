@if($heroMedia && $heroEnabled)
<div class="top-img w-100">
    <img src="{{ $heroMedia->getUrl() }}" 
         alt="Hero Image" 
         class="w-100">
</div>
@endif