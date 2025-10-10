<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Site extends BaseController
{
    public function forbidden()
    {
        return $this->view('templates/forbidden', [], false);
    }

    public function show404()
    {
        return $this->view('templates/404', [], false);
    }

    public function test() {
        $email = service('email');
        $email->setTo('user@user.com');
        $email->setSubject('Test');
        $email->setMessage('ceci est un Test');
        if ($email->send()) {
            echo 'ok';
        } else {
            echo $email->printDebugger(['headers']);
        }
    }
}
