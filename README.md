# Editable Blocks

##### When content editing comes as an afterthought or is super minimal

-------
Lets you bolt-on some simple content editing logic.

### What it will do for you:

 * Take care of the content blocks, both front and back end

### What it will **not** do for you:
 * Take care of auth
 * Provide fancy UI (no save or history, no rich editor libraries)

![alt text](http://i.imgur.com/SE1l5Op.gif "Demo")

### Installation
 * Download and copy the files somewhere
 * Run ```$ composer install``` in the library's directory
 * Run ```$ php publishAssets.php```, this will copy the frontend files (asks for path)

### Usage
See example/index.php for a complete dummy file.

Below are the important parts.

In your controller (or equivalent):
```php
require '../EditableBlocks/EditableBlocks.php';

$editableBlocks = new \EditableBlocks\EditableBlocks();
$editableBlocks->setAccess(true); // This is where you check for auth!
$editableBlocks->setAssetsUrl('assets/editable_blocks');
$editableBlocks->setBackendEndpointUrl('/editable_blocks_controller.php');
```
In your head view (or equivalent):
```php
<?php $editableBlocks->assets(); ?>
```
In your content view (or equivalent):
```html
<div class='content'>
    <div class='content-a'>
        <?php $editableBlocks->render(['id' => 'example-block']) /* Config array as argument */ ?>
    </div>
    <!-- content-a -->

    <div class='content-b'>
        <?php $editableBlocks->render('example-block-b') /* ID string as argument */ ?>
    </div>
    <!-- content-b -->
</div>
<!-- content -->
```
