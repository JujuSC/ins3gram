<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <?php if (isset($user)) : ?>
                    <h1>Modification de <?= $user->username ; ?></h1>
                <?php else : ?>
                    <h1>Création d'un nouvel utilisateur</h1>
                <?php endif; ?>
            </div>
            <?php
            if(isset($user)):
                echo form_open('admin/user/update');
            else:
                echo form_open('admin/user/create');
            endif;
            ?>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col md-6">
                        <label for="first_name" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="first_name" value="<?= (isset($user->first_name)) ? $user->first_name : ""; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="last_name" value="<?= (isset($user->last_name)) ? $user->last_name : ""; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" value="<?= (isset($user->username)) ? $user->username : ""; ?>" required>
                    </div>
                    <div class="col-md-12">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" <?= isset($user->id) ? '' : 'required'; ?>>
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="<?= (isset($user->email)) ? $user->email : "example@mail.com"; ?>"
                               value="<?= (isset($user->email)) ? $user->email : ""; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="birthdate" class="form-label">Date de naissance</label>
                        <input type="date" id="birthdate" class="form-control"
                               value="<?= (isset($user->birthdate)) ? date('Y-m-d',strtotime($user->birthdate)): set_value('birthdate');?>" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="id_permission">Permission</label>
                        <select class="form-select" name="id_permission" id="id_permission">
                            <?php foreach ($permissions as $perm) : ?>
                                <option value="<?= $perm['id']; ?>"
                                    <?= (isset($user->id_permission) && ($user->id_permission == $perm['id'])) ? 'selected' : ''; ?>>
                                    <?= $perm['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 text-end">
                    <?php if (isset($user->id)) : ?>
                            <input type="hidden" name="id" value="<?= $user->id; ?>">
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary">Créer un compte</button>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
            <?php
            echo form_close();
            ?>
        </div>
    </div>
</div>
