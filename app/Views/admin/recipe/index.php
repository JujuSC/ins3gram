<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Liste des recettes</h3>
                <a href="<?= base_url('/admin/recipe/new'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Nouvelle Recette</a>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-striped" id="recipesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Créateur</th>
                            <th>Date modif.</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var baseUrl = "<?= base_url(); ?>";
        var table = $('#recipesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('datatable/searchdatatable') ?>',
                type: 'POST',
                data: {
                    model: 'RecipeModel'
                }
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'user_username' },
                { data: 'updated_at' },
                { data: 'status',
            render: function(data, type, row) {
            if (data === 'active' || row.deleted_at === null) {
                return '<span class="badge text-bg-success">Actif</span>';
            } else {
                return '<span class="badge text-bg-danger">Inactif</span>';
            }
        }
    },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        const isActive = (row.status === 'active' || row.deleted_at === null);
                        const toggleButton = isActive
                            ? `<button class="btn btn-sm btn-danger" onclick="toggleUserStatus(${row.id}, 'deactivate')" title="Désactiver">
                                 <i class="fas fa-user-times"></i>
                               </button>`
                            : `<button class="btn btn-sm btn-success" onclick="toggleUserStatus(${row.id}, 'activate')" title="Activer">
                                 <i class="fas fa-user-check"></i>
                               </button>`;
                        return `
                            <div class="btn-group" role="group">
                                <button onclick="showModal(${row.id},'${row.name}')"  class="btn btn-sm btn-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteBrand(${row.id})" class="btn btn-sm btn-danger" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            language: {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            }
        });

        // Fonction pour actualiser la table
        window.refreshTable = function() {
            table.ajax.reload(null, false); // false pour garder la pagination
        };
    });
</script>