<?php

$section = Craft::$app->sections->getSectionByHandle('testStructure');

return [
    [
        'authorId' => '1',
        'sectionId' => $section->id,
        'typeId' => $section->entryTypes[0]->id,
        'slug' => 'structure-grandparent',
        'title' => 'Grandparent',
    ],
];
