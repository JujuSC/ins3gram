<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <?php if(isset($ingredient)) : ?>
                    Modification de <?= $ingredient['name']; ?>
                <?php else : ?>
                    Création d'un ingrédient
                <?php endif;?>
            </div>
            <?php if(isset($ingredient)) :
            echo form_open('admin/ingredient/update'); ?>
            <input type="hidden" name="id" value="<?= $ingredient['id']; ?>">
            <?php else :
            echo form_open('admin/ingredient/insert'); ?>
            <?php endif;?>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" name="name" id="name" class="form-control"
                           value="<?= isset($ingredient['name']) ? $ingredient['name'] : '' ?>">
                    <label for="name">Nom de l'ingrédient</label>
                </div>
                <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="id_brand" id="id_brand" class="form-select">
                            <option disabled>Choisir une marque...</option>
                            <?php foreach ($brands as $brand) : ?>
                            <option value="<?= $brand['id']; ?>"><?= $brand['name']; ?></option>
                            <?php endforeach;?>
                        </select>
                        <label for="id_brand">Nom de la marque</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="id_categ" id="id_categ" class="form-select">
                            <option disabled>Choisir une catégorie...</option>
                            <?php foreach ($categs as $categ) : ?>
                            <option value="<?= $categ['id']; ?>"><?= $categ['name']; ?></option>
                            <?php endforeach;?>
                        </select>
                        <label for="id_categ">Catégorie</label>
                    </div>
                </div>
                </div>
                <div class="form-floating">
                    <textarea name="description" id="description" class="form-control"></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="<?= base_url('admin/ingredient'); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour
                </a>
                <div>
                    <?php if(isset($ingredient)) : ?>
                        <!-- Si modification : bouton "Mettre à jour" -->
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Mettre à jour
                        </button>
                    <?php else : ?>
                        <!-- Si création : bouton pour réinitialiser + bouton pour créer -->
                        <button type="reset" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-undo me-1"></i>Réinitialiser
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Créer l'ingrédient
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close()?>
    </div>
</div>
