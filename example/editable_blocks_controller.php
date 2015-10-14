<?php

require '../EditableBlocks/EditableBlocks.php';

$editableBlocks = new \EditableBlocks\EditableBlocks();
$editableBlocks->setAccess(true); // Do this only if user is logged in as admin in your own project!

$editableBlocks->controller();
