<?php

namespace EditableBlocks;

require __DIR__ . '/vendor/autoload.php';

use App\EditableBlocksModel;
use Illuminate\Database\Capsule\Manager as Capsule;

class EditableBlocks
{
    public $accessGranted;
    public $capsule;
    public $idMaxLength;

    public function __construct()
    {
        $this->capsule = new Capsule;
        $this->idMaxLength = 50;

        $this->capsule->addConnection([
            'driver' => 'sqlite',
            'database' => __DIR__ . '/app/editable_blocks.sqlite',
            'prefix' => '',
        ], 'default');

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();

        $this->connection = $this->capsule->getConnection('default');
    }

    public function setAccess($bool = false)
    {
        $this->accessGranted = (bool) $bool;
    }

    public function render($args)
    {
        $id = $args['id'];
        $echo = isset($args['echo']) ? $args['echo'] : true;
        $element = isset($args['element']) ? $args['element'] : 'div';

        $output = '<' . $element . '>';

        $blockRow = EditableBlocksModel::find($id);

        if (is_null($blockRow))
        {
            // Row doesn't exist, create it
            $blockRow = new EditableBlocksModel();
            $blockRow->id = $id;
            $blockRow->content = '---';
            $blockRow->save();
            return $this->render($id, $echo);
        }

        $output .= $blockRow->content;
        $output .= '</' . $element . '>';

        if ($echo)
        {
            echo $output;
            return;
        }

        return $output;
    }
}
