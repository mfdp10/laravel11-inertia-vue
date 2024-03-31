<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

if (!function_exists('translations')) {

    function translations()
    {
        $locale = App::getLocale();
        $phpTranslations = [];
        $jsonTranslations = [];

        if (File::exists(base_path("lang/$locale"))) {
            $phpTranslations = collect(File::allFiles(base_path("lang/$locale")))
                ->filter(function ($file) {
                    return $file->getExtension() === "php";
                })->flatMap(function ($file) {
                    return Arr::dot(File::getRequire($file->getRealPath()));
                })->toArray();
        }

        if (File::exists(base_path("lang/$locale"))) {
            $jsonTranslations = json_decode(File::get(base_path("lang/$locale.json")), true);
        }

        return array_merge($phpTranslations, $jsonTranslations);


        // if (!file_exists($json)) {
        //     return [];
        // }
        // return json_decode(file_get_contents($json), true);
    }
}
