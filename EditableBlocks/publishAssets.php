<?php

require __DIR__ . '/app/quickcli.php';

$cli = new QuickCLI\QuickCLI();

$myDir = $cli->prompt('Please enter the full path where to publish the assets (e.g. "/var/www/html/project-x/public/assets/content_editable/")', true);

// I'm going nuts...
if ($myDir === 'x')
{
    $myDir = '/var/www/editable-blocks/example/assets/editable_blocks';
}

$myDir = rtrim(trim($myDir), '/') . '/';

$cli->line('Copying asset files to ' . $myDir);

$source = __DIR__ . '/assets/*';
$destination = $myDir;

if ( ! is_dir($destination))
{
    mkdir($destination);
}

$command = 'cp -r ' . $source . ' ' . $destination;

$output = shell_exec($command);
$cli->line($output);

$cli->line('Done!');

// /var/www/editable-blocks/example/assets/editable_blocks