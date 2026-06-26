<?php

namespace App\Services;

use Artesaos\SEOTools\Facades\SEOTools;

class SeoService
{
    public static function home($settings)
    {
        SEOTools::setTitle(($settings['site_name'] ?? 'سون شاپ') . ' | ' . config('app.name'));

        SEOTools::setDescription($settings['meta_description'] ?? '');

        SEOTools::metatags()->setKeywords([
            'سون شاپ',
            'فروشگاه اینترنتی',
            'خرید آنلاین'
        ]);

        SEOTools::setCanonical(request()->url());

        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->setTitle($settings['site_name'] ?? 'سون شاپ');
        SEOTools::opengraph()->setDescription($settings['meta_description'] ?? '');
        SEOTools::opengraph()->addImage(asset('images/og-default.jpg'));

        SEOTools::twitter()->setTitle(
            ($settings['site_name'] ?? 'سون شاپ') . ' | ' . config('app.name')
        );

        SEOTools::jsonLd()->setType('WebSite');
        SEOTools::jsonLd()->setUrl(url('/'));
    }
}
