<?php

namespace App\Support;

class HtmlSanitizer
{
    private const ALLOWED_TAGS = '<p><br><strong><em><b><i><u><ul><ol><li><h2><h3><h4><a><blockquote><table><thead><tbody><tr><th><td>';

    public static function clean(?string $html): string
    {
        if ($html === null || $html === '') {
            return '';
        }

        $clean = strip_tags($html, self::ALLOWED_TAGS);
        $clean = preg_replace('/\s*on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $clean) ?? $clean;
        $clean = preg_replace('/\s*href\s*=\s*("\s*javascript:[^"]*"|\'\s*javascript:[^\']*\')/i', '', $clean) ?? $clean;

        return trim($clean);
    }
}
