<?php

namespace craftunittests\fixtures;

use craft\test\fixtures\elements\EntryFixture;

class StructureFixture extends EntryFixture
{
    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/structure.php';

    /**
     * @inheritdoc
     */
    public $depends = [
        // ✨ This ensures that the parent enetry is created first
        StructureParentFixture::class
    ];
}
