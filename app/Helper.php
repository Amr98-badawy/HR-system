<?php

use App\Models\SiteLanguage;

function siteLanguages(): array
{
    $langs = SiteLanguage::orderBy('id', 'asc')->pluck('locale')->toArray();

    if (count($langs) == 0) {
        return config('translatable.locales');
    }

    return $langs;
}
