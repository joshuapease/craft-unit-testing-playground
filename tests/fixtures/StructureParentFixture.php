<?php

namespace craftunittests\fixtures;

use craft\test\fixtures\elements\EntryFixture;

class StructureParentFixture extends EntryFixture
{
    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/structure-parent.php';

    /**
     * @inheritdoc
     */
    public $depends = [
        // ✨ This ensures that the parent entry is created first
        StructureGrandparentFixture::class
    ];
}
