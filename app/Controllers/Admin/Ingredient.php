<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Ingredient extends BaseController
{
    public function search()
    {
        $request = $this->request;

        // Vérification AJAX
        if (!$request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Requête non autorisée']);
        }

        $im = Model('IngredientModel');

        // Paramètres de recherche
        $search = $request->getGet('search') ?? '';
        $page = (int)($request->getGet('page') ?? 1);
        $limit = 20;

        // Utilisation de la méthode du Model (via le trait)
        $result = $im->quickSearchForSelect2($search, $page, $limit);

        // Réponse JSON
        return $this->response->setJSON($result);
    }

    public function index()
    {
        return $this->view('/admin/ingredient/index');
    }

    public function create()
    {
        helper('form');
        $brands = Model('BrandModel')->findAll();
        $categs = Model('CategIngModel')->findAll();
        return $this->view('/admin/ingredient/form', ['brands'=>$brands,'categs'=>$categs]);
    }

    public function insert()
    {
        $im = Model('IngredientModel');
        $data = $this->request->getPost();
        if ($im->insert($data)) {
            $this->success ('Ingrédient créé');
        } else {
            foreach ($im->errors() as $error) {
                $this->error($error);
            }
        }
        return $this->redirect('/admin/ingredient');
    }

    public function edit($id_ingredient) {
        $im = Model('IngredientModel');
        $ingredient = $im->find($id_ingredient);
        if (!$ingredient) {
            $this->error('Ingredient inexistant');
            return $this->redirect('/admin/ingredient');
        }
        helper('form');
        $brands = Model('brandModel')->findAll();
        $categs = Model('CategIngModel')->findAll();
        return $this->view('/admin/ingredient/form', ['ingredient'=>$ingredient,'brands'=>$brands,'categs'=>$categs]);
    }

    public function update()
    {
        $im = Model('IngredientModel');
        $data = $this->request->getPost();
        $id = $data['id'];
        unset($data['id']);
        if ($im->update($id, $data)) {
                $this->success('Ingrédient mis à jour avec succès.');
                return $this->redirect('/admin/ingredient/');
            } else {
                $this->error('Erreur');
                return $this->redirect('/admin/ingredient/');
            }
    }

    public function delete() {
        $im = Model('IngredientModel');
        $id = $this->request->getPost();
        if ($im->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'L\'ingrédient a été supprimée avec succès !',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => $im->errors()
            ]);
        }
    }
}