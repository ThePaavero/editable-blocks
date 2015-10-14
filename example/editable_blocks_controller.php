<?php

require '../EditableBlocks/EditableBlocks.php';

$editableBlocks = new \EditableBlocks\EditableBlocks();
$editableBlocks->setAccess(true);

$editableBlocks->controller();
