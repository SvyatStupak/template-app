<?php

namespace App\Services;

class Router {
    private static $link = [];

    public static function page($uri, $page) {
        self::$link[] = [
            'uri' => $uri,
            'page' => $page
        ];
    }

    public static function ebable() {
        debug(self::$link);
    }
}