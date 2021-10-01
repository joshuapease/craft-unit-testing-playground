<?php

namespace craftunittests\unit;

use Codeception\Test\Unit;
use UnitTester;
use craft\elements\Entry;
use craft\helpers\App;
use modules\craftunit\Module;
use craftunittests\fixtures\StructureFixture;

class GetBreadcrumbsFromAncestorsTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function _fixtures(): array
    {
        return [
            'entries' => [
                'class' => StructureFixture::class,
            ],
        ];
    }

    public function testGetBreadcrumbsFromAncestors()
    {
        $primaryUrl = App::env('PRIMARY_SITE_URL');

        // 🔍 Query by slug to find structure-child
        $entry = Entry::findOne([
            'slug' => 'structure-child',
        ]);

        $breadcrumbs = Module::getInstance()->getNav()->getBreadcrumbsFromAncestors($entry);

        $this->assertEquals([
            [
                'title' => 'Grandparent',
                'url' => "{$primaryUrl}/test-structure/structure-grandparent",
            ],
            [
                'title' => 'Parent',
                'url' => "{$primaryUrl}/test-structure/structure-grandparent/structure-parent",
            ],
        ], $breadcrumbs);
    }

    public function testGetBreadcrumbsFiltering()
    {
        $primaryUrl = App::env('PRIMARY_SITE_URL');

        // 🔍 Query by slug to find structure-child
        $entry = Entry::findOne([
            'slug' => 'structure-child',
        ]);

        $options = [
            'filter' => function (Entry $entry) {
                return $entry->slug !== 'structure-grandparent';
            },
        ];

        $breadcrumbs = Module::getInstance()->getNav()->getBreadcrumbsFromAncestors($entry, $options);

        $this->assertEquals([
            [
                'title' => 'Parent',
                'url' => "{$primaryUrl}/test-structure/structure-grandparent/structure-parent",
            ],
        ], $breadcrumbs);
    }

    public function testGetBreadcrumbsCustomPrependAppend()
    {
        $primaryUrl = App::env('PRIMARY_SITE_URL');

        // 🔍 Query by slug to find structure-child
        $entry = Entry::findOne([
            'slug' => 'structure-child',
        ]);

        $options = [
            'prepend' => [
                [
                    'title' => 'Before',
                    'url' => 'before',
                ],
            ],
            'append' => [
                [
                    'title' => 'After',
                    'url' => 'after',
                ],
            ],
        ];

        $breadcrumbs = Module::getInstance()->getNav()->getBreadcrumbsFromAncestors($entry, $options);

        $this->assertEquals([
            [
                'title' => 'Before',
                'url' => 'before',
            ],
            [
                'title' => 'Grandparent',
                'url' => "{$primaryUrl}/test-structure/structure-grandparent",
            ],
            [
                'title' => 'Parent',
                'url' => "{$primaryUrl}/test-structure/structure-grandparent/structure-parent",
            ],
            [
                'title' => 'After',
                'url' => 'after',
            ],
        ], $breadcrumbs);
    }
}
