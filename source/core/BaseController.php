<?php

namespace source\core;

use source\core\components\UserComponent;
use source\core\view\CompositeView;
use source\core\view\View;

class BaseController extends Object
{
    public $templateHeader = 'templates/header';
    public $templateFooter = 'templates/footer';

    public function render($file, $variables = [])
    {
        $userComponent = UserComponent::getInstance();
        $user = $userComponent->getUserModel();

        $header = new View($this->templateHeader);
        $header->setField('username', !empty($user) ? $user->getUsername() : '');

        $body = new View($file);
        foreach ($variables as $variable => $value) {
            $body->setField($variable, $value);
        }

        $footer = new View($this->templateFooter);

        $compositeView = new CompositeView;

        return $compositeView->attachView($header)
            ->attachView($body)
            ->attachView($footer)
            ->render();
    }
}