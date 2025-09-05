<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CategIng extends BaseController
{
    public function index()
    {
        helper('form');
        $categ = Model ('CategIngModel')->orderBy('name')->findAll();
        return $this->view('admin/categing', ['categ' => $categ]);
    }

    public function insert()
    {
        $cm = Model('CategIngModel');
        $data = $this->request->getPost();
        if(empty($data['id_categ_parent'])) unset($data['id_categ_parent']);
        if ($cm->insert($data)) {
            $this->success ('Catégorie créée');
        } else {
            foreach ($cm->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('/admin/categing');
    }

    public function update()
    {
        $cm = Model('CategIngModel');
        $data = $this->request->getPost();
        $id = $data['id'];
        unset($data['id']);
        if ($cm->update($id, $data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Ca fonctionne !',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => $cm->errors()
            ]);
        }
    }

    public function delete()
    {
        $cm = Model('CategIngModel');
        $id = $this->request->getPost();
        if ($cm->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'La catégorie a été supprimée avec succès !',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => $cm->errors()
            ]);
        }
    }
}
