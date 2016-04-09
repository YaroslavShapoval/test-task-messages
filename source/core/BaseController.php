<?php

namespace source\core;

use source\core\view\CompositeView;
use source\core\view\View;

class BaseController extends Object
{
    public $templateHeader = 'templates/header';
    public $templateFooter = 'templates/footer';

    public function render($file, $variables)
    {
        $header = new View($this->templateHeader);
        $header->setField('username', '');

        $body = new View($file);
        foreach ($variables as $variable => $value) {
            $body->setField($variable, $value);
        }

        $footer = new View($this->templateFooter);
        $footer->setField('date', date('Y-m-d H:i:s T'));

        $compositeView = new CompositeView;

        return $compositeView->attachView($header)
            ->attachView($body)
            ->attachView($footer)
            ->render();
    }
}