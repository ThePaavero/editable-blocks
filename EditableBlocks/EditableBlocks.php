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
    public $assetsBaseUrl;
    public $backendEndpointUrl;

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
        if (is_string($args))
        {
            $args = [
                'id' => $args
            ];
        }

        $id = $args['id'];

        $echo = isset($args['echo']) ? $args['echo'] : true;
        $element = isset($args['element']) ? $args['element'] : 'div';

        if ( ! $this->validateIdString($id))
        {
            $output = '<div class="editable-blocks error-message">Invalid ID, it has to be under ' . $this->idMaxLength . ' characters long and alphanumeric with dashes only!</div>';
            return $echo ? print($output) : $output;
        }

        $blockRow = EditableBlocksModel::find($id);

        if (is_null($blockRow))
        {
            // Row doesn't exist, create it
            $blockRow = new EditableBlocksModel();
            $blockRow->id = $id;
            $blockRow->content = '---';
            $blockRow->save();
            return $this->render($args);
        }

        if ($this->accessGranted)
        {
            $output = '<' . $element . ' contenteditable class="editable-blocks-content-block" data-editable-blocks-content-id="' . $blockRow->id . '">';
        }
        else
        {
            $output = '<' . $element . '>';
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

    public function setAssetsUrl($url)
    {
        $this->assetsBaseUrl = rtrim(trim($url), '/') . '/';
    }

    public function setBackendEndpointUrl($url)
    {
        $this->backendEndpointUrl = $url;
    }

    public function assets()
    {
        if ( ! $this->accessGranted)
        {
            return '';
        }

        if ( ! isset($this->assetsBaseUrl))
        {
            die('You need to call setAssetsUrl()!');
        }

        $myPublicJavascriptConfig = json_encode([
            'controllerEndpointUrl' => $this->backendEndpointUrl
        ]);

        $output = '<script>window.EditableBlocksConfig = ' . $myPublicJavascriptConfig . '</script>';
        $output .= '<link rel="stylesheet" href="' . $this->assetsBaseUrl . 'css/styles.css">' . "\n    ";
        $output .= '<script src="' . $this->assetsBaseUrl . 'js/main.js"></script>';

        echo $output;
    }

    public function controller()
    {
        return ':D:D:D';
    }

    private function validateIdString($str)
    {
        if (strlen($str) > $this->idMaxLength)
        {
            return false;
        }

        return preg_match('/^[A-Za-z0-9_~\-!@#\$%\^&*\(\)]+$/', $str);
    }
}
