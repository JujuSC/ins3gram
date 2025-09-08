<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Tag extends BaseController
{
    public function index()
    {
        helper('form');
        return $this->view('admin/tag');
    }
    public function insert()
    {
        $bm = Model('TagModel');
        $data = $this->request->getPost();
        if ($bm->insert($data)) {
            $this->success ('Tag créé');
        } else {
            foreach ($bm->errors() as $key => $error) {
                $this->error($key . ' : ' . $error);
            }
        }
        return $this->redirect('/admin/tag');
    }

    public function update()
    {
        $bm = Model('TagModel');
        $data = $this->request->getPost();
        $id = $data['id'];
        unset($data['id']);
        if ($bm->update($id, $data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Ca fonctionne !',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => $bm->errors()
            ]);
        }
    }
    public function delete() {
        $bm = Model('TagModel');
        $id = $this->request->getPost();
        if ($bm->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Tag supprimé avec succès !',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => $bm->errors()
            ]);
        }
    }
}
