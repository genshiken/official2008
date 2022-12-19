<?php

declare(strict_types=1);

function e(string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES, "UTF-8");
}

function tag(string $tag, ?array $attributes, ?string $content = null): string
{
    $attributesString = '';
    foreach ($attributes ?? [] as $key => $value) {
        $attributesString .= ' '.e($key).'="'.e($value).'"';
    }
    $content ??= '';

    return "<{$tag}{$attributesString}>{$content}</{$tag}>";
}
