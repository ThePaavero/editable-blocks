<?php

require '../EditableBlocks/EditableBlocks.php';

$editableBlocks = new \EditableBlocks\EditableBlocks();
$editableBlocks->setAccess(true);

?><!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Example</title>
</head>
<body>
<div class='content'>
    <?php $editableBlocks->render([
        'id' => 'example-block'
    ]) ?>
</div>
<!-- content -->
</body>
</html>