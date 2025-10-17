<?php

namespace App\Support;

use League\CommonMark\CommonMarkConverter;
use Symfony\Component\Yaml\Yaml;

class ContentStore
{
    /** @var string */
    private $base;
    /** @var CommonMarkConverter */
    private $md;

    public function __construct()
    {
        $this->base = resource_path('content');
        $this->md = new CommonMarkConverter();
    }

    /**
     * @param string $slug
     * @return array{meta: array, html: string}
     */
    public function pageMarkdown($slug)
    {
        $path = $this->base . "/pages/{$slug}.md";
        $raw = is_file($path) ? file_get_contents($path) : '';
        $meta = array();
        $body = $raw;

        if (preg_match('/^---\s*(.*?)\s*---\s*(.*)$/s', (string) $raw, $m)) {
            $meta = Yaml::parse($m[1]) ?: array();
            $body = $m[2];
        }

        $html = $this->md->convert((string) $body)->getContent();

        return array(
            'meta' => $meta,
            'html' => $html,
        );
        // bez deklaracji typów zwrotnych
    }

    /**
     * @param string $relPath
     * @return mixed
     */
    public function yaml($relPath)
    {
        $path = $this->base . '/' . ltrim($relPath, '/');
        $src = is_file($path) ? file_get_contents($path) : '';
        $out = Yaml::parse($src);
        return $out ?: array();
    }

    /**
     * @return array<int, array<string,mixed>>
     */
    public function fleet()
    {
        $files = glob($this->base . '/fleet/*.yml');
        if (!$files) $files = array();
        $out = array();
        foreach ($files as $f) {
            $parsed = Yaml::parse(file_get_contents($f) ?: '');
            $out[] = $parsed ?: array();
        }
        return $out;
    }
}
