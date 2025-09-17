<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Brand extends BaseController
{
    public function index()
    {
        helper('form');
        return $this->view('admin/brand');
    }

    public function insert()
    {
        $bm = Model('BrandModel');
        $data = $this->request->getPost();
        $image = $this->request->getFile('image');
        if ($id_brand = $bm->insert($data)) {
            $this->success ('Marque créée');
            if($image && $image->getError() !== UPLOAD_ERR_NO_FILE){
                $mediaData = [
                    'entity_type' => 'brand',
                    'entity_id' => $id_brand,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                //Utiliser la fonction upload_file pour gérer l'upload du média
                $uploadResult = upload_file($image, 'Brand', $image->getName(), $mediaData, false);
                //Vérifier le résultat de l'upload
                if (is_array($uploadResult) && $uploadResult['status'] === 'error') {

                }
            }
        } else {
            foreach ($bm->errors() as $key => $error) {
                $this->error($key . ' : ' . $error);
            }
        }
        return $this->redirect('/admin/brand');
    }

    public function update()
    {
        $bm = Model('BrandModel');
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
        $bm = Model('BrandModel');
        $id = $this->request->getPost();
        if ($bm->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'La marque a été supprimée avec succès !',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => $bm->errors()
            ]);
        }
    }
}
