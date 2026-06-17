<?php

namespace App\Support;

class RichText
{
    /**
     * Strip inline text/background color from rich-text HTML (e.g. content
     * pasted from Word/Google Docs into Summernote) so the site theme controls
     * colors and text stays readable on the dark frontend.
     *
     * Removes `color`, `background-color`, and `background` declarations from
     * inline `style` attributes (keeping any other declarations such as
     * text-align or font-weight), and strips the deprecated `color`/`bgcolor`
     * presentational attributes.
     */
    public static function stripColorStyles(?string $html): ?string
    {
        if ($html === null || trim($html) === '') {
            return $html;
        }

        // Remove color/background declarations from inline style="..." attributes.
        $html = preg_replace_callback(
            '/\sstyle\s*=\s*(["\'])(.*?)\1/is',
            function (array $m): string {
                $quote = $m[1];

                $cleaned = preg_replace(
                    '/(?:^|;)\s*(?:color|background-color|background)\s*:[^;]*/i',
                    '',
                    $m[2]
                );

                $cleaned = trim($cleaned, " \t\n\r;");

                // Drop the attribute entirely if nothing meaningful remains.
                return $cleaned === '' ? '' : ' style=' . $quote . $cleaned . $quote;
            },
            $html
        );

        // Remove deprecated presentational color attributes (e.g. <font color>, bgcolor).
        return preg_replace('/\s(?:color|bgcolor)\s*=\s*(["\']).*?\1/is', '', $html);
    }
}
