<?php

namespace Controller;

use Lib\View;

class DefaultController
{
    public function indexAction()
    {
        return View::renderTemplate('Page/index', [
            'title' => 'Homepage'
        ]);
    }

    public function errorAction()
    {
        return View::renderTemplate('Page/error', [
            'title' => 'Error'
        ]);
    }

}