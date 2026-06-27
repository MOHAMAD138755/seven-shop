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

    public static function product($product)
    {
        SEOTools::setTitle($product->name);

        SEOTools::setDescription(
            $product->short_description ?? strip_tags($product->description)
        );

        SEOTools::setCanonical(url()->current());

        SEOTools::opengraph()->setTitle($product->name);
        SEOTools::opengraph()->setDescription($product->description);
        SEOTools::opengraph()->addImage($product->image);

        SEOTools::twitter()->setTitle($product->name);

        SEOTools::jsonLd()->setType('Product');
        SEOTools::jsonLd()->setUrl(url()->current());
    }

    public static function category($category)
    {
        SEOTools::setTitle($category->name);

        SEOTools::setDescription($category->description ?? 'خرید انواع ' . $category->name . ' با بهترین قیمت');

        SEOTools::setCanonical(url()->current());

        SEOTools::opengraph()->setTitle($category->name);
        SEOTools::opengraph()->setDescription(
            $category->description
            ?? 'خرید انواع ' . $category->name . ' با بهترین قیمت'
        );
        SEOTools::opengraph()->addImage(asset('images/og-default.jpg'));

        SEOTools::jsonLd()->setType('WebPage');
    }
}
