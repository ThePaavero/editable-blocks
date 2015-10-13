<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditableBlocksModel extends Model
{
    protected $table = 'blocks';

    public function __construct()
    {
        Parent::__construct();
    }
}
