<?php

$databasePath = __DIR__ . '/app/editable_blocks.sqlite';

if (file_exists($databasePath))
{
    echo 'Deleting current database file...' . PHP_EOL;
    unlink($databasePath);
    echo 'Done.' . PHP_EOL;
}

echo 'Creating new database file...' . PHP_EOL;
touch($databasePath);
echo 'Done.' . PHP_EOL;

$sql = 'CREATE TABLE [blocks] (
[id] CHAR(50) NOT NULL,
[created_at] DATETIME,
[updated_at] DATETIME,
[content] TEXT);

CREATE INDEX [pk] ON [blocks] ([id]);';

echo 'Creating table(s)...' . PHP_EOL;
$db = new PDO('sqlite:' . $databasePath);
$db->exec($sql);
echo 'All done!' . PHP_EOL . PHP_EOL;
