<?php

namespace App\Enums;

use Laravel\Pennant\Feature;

enum PageFeatureEnum: string
{
    case HOME = 'page-home';
    case HOME_HERO_IMG = 'page-home-hero-img';
    case HOME_CONTACT = 'page-home-contact';
    case HOME_SLIDER = 'page-home-slider';
    case SERVICES = 'page-services';
    case VIDEO_GALLERY = 'page-video-gallery';

    public function is_enabled(): bool
    {
        return Feature::active($this->value);
    }

    public function enable(): void
    {
        Feature::activate($this->value);
    }

    public function disable(): void
    {
        Feature::deactivate($this->value);
    }

    // Flip the current state
    public function toggle(): void
    {
        $this->is_enabled() ? $this->disable() : $this->enable();
    }

    // Optional: set state directly
    public function set(bool $enabled): void
    {
        $enabled ? $this->enable() : $this->disable();
    }

    public function status(): string
    {
        return $this->is_enabled() ? 'enabled' : 'disabled';
    }
}
