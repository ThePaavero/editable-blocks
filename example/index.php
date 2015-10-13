<?php

require '../EditableBlocks/EditableBlocks.php';

$editableBlocks = new \EditableBlocks\EditableBlocks();
$editableBlocks->setAccess(true);

?><!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Example</title>
    <?php $editableBlocks->assets('assets/editable_blocks'); ?>
</head>
<body>
<div class='content'>
    <div class='content-a'>
        <?php $editableBlocks->render(['id' => 'example-block']) ?>
    </div>
    <!-- content-a -->

    <div class='content-b'>
        <?php $editableBlocks->render('example-block-b') ?>
    </div>
    <!-- content-b -->
</div>
<!-- content -->
</body>
</html>