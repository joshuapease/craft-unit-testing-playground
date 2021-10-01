<?php

namespace modules\craftunit\services;

use Craft;
use craft\elements\Entry;

class Nav
{

    /**
     * Create an array of breadcrumbs from an Entries
     *
     * @param Entry $entry
     * @param array $options
     * @return array|
     */
    public static function getBreadcrumbsFromAncestors(Entry $entry, array $options = []): array
    {
        $defaultOptions = [
            'prepend' => [],
            'append' => [],
            'filter' => null,
        ];

        $config = array_merge($defaultOptions, $options);

        if (!$entry->hasEagerLoadedElements('ancestors')) {
            Craft::$app->elements->eagerLoadElements(Entry::class, [$entry], ['ancestors']);
        }

        $ancestors = (array) $entry->ancestors;

        if (is_callable($config['filter'])) {
            $ancestors = array_filter($ancestors, $config['filter']);
        }

        $ancestors = array_map(fn ($entry) => [
            'title' => $entry->title,
            'url' => $entry->url,
        ], $ancestors);

        return [
            ...$config['prepend'],
            ...$ancestors,
            ...$config['append'],
        ];
    }
}
