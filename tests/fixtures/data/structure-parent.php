<?php

use craft\elements\Entry;

$section = Craft::$app->sections->getSectionByHandle('testStructure');
// ✨ This is where slugs come in handy
$parent = Entry::findOne(['slug' => 'structure-grandparent']);

return [
    [
        'authorId' => '1',
        'sectionId' => $section->id,
        'typeId' => $section->entryTypes[0]->id,
        'slug' => 'structure-parent',
        'title' => 'Parent',
        'newParentId' => $parent->id,
    ],
];
