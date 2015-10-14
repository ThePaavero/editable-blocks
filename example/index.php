<?php

require '../EditableBlocks/EditableBlocks.php';

$editableBlocks = new \EditableBlocks\EditableBlocks();
$editableBlocks->setAccess(true);
$editableBlocks->setAssetsUrl('assets/editable_blocks');
$editableBlocks->setBackendEndpointUrl('/editable_blocks_controller.php');

?><!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Example</title>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
    <?php $editableBlocks->assets(); ?>
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