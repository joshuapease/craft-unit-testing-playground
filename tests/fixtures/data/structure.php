<?php

use craft\elements\Entry;

$section = Craft::$app->sections->getSectionByHandle('testStructure');
$parent = Entry::findOne(['slug' => 'structure-parent']);

return [
    [
        'authorId' => '1',
        'sectionId' => $section->id,
        'typeId' => $section->entryTypes[0]->id,
        'slug' => 'structure-child',
        'title' => 'Child',
        'newParentId' => $parent->id,
    ],
];
