<div class="row">
    <div class="col mb-3">
        <div class="position-relative">
            <?php if(isset($recipe['mea'])) : ?>
                <img src="<?= $recipe['mea']->getUrl() ?>" class="img-fluid recipe-img-mea">
            <?php endif; ?>
            <div class="position-absolute top-0 start-0 bg-black w-100 h-100 opacity-25">
            </div>
            <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
                <h1><?= isset($recipe['name']) ? $recipe['name'] : ''; ?></h1>
                Proposé par : <?= isset($recipe['user']) ? $recipe['user']->username : ''; ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <div data-value="1" id="scoreOpinion">
            <i data-value="1" class="fas fa-2xl fa-star"></i>
            <i data-value="2" class="far fa-2xl fa-star"></i>
            <i data-value="3" class="far fa-2xl fa-star"></i>
            <i data-value="4" class="far fa-2xl fa-star"></i>
            <i data-value="5" class="far fa-2xl fa-star"></i>
        </div>
    </div>
    <div class="col text-center" id="favorite" data-value="0" >
        <?php if( ($session_user != null) && $session_user->hasFavorite($recipe['id']) ) :
            $text_favorite = 'Supprimer de mes favoris';
            $class_favorite = 'fas';
        else :
            $text_favorite = 'Ajouter des favoris';
            $class_favorite = 'far';
        endif; ?>
        <div id="heart" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $text_favorite ?>>" title="<?= $text_favorite ?>">
            <i class="<?= $class_favorite ?> fa-heart fa-2xl text-danger"></i>
        </div>
    </div>
    <div class="col text-center">
        <?= social_share_links(current_url(), $recipe['name'] . ' - Ins3gram'); ?>
    </div>
<!-- START: TAGS-->
<div class="row py-3">
    <div class="">
        <?php if (isset($recipe['tags']) && !empty($recipe['tags'])): ?>
            <?php foreach ($recipe['tags'] as $tag): ?>
                <span class="badge text-bg-primary"><?= esc($tag['name']) ?></span>
            <?php endforeach; ?>
        <?php else: ?>
            <span class="text-muted">Aucun mot-clé associé</span>
        <?php endif; ?>
    </div>
</div>
<!-- END: TAGS-->
<!-- START :INGREDIENTS-->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h2>Ingrédients</h2>
            </div>
            <div class="card-body ">
                <div class=" row row-cols-2 row-cols-md-4">
                    <?php foreach($ingredients as $ing) : ?>
                        <div class="col">
                            <?= $ing['ingredient']?> - <?= $ing['quantity']?> <?= $ing['unit'] ?>
                        </div>
                    <?php endforeach ; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: INGREDIENTS -->
<div class="row">
    <?php if(!empty($recipe['images'])) : ?>
    <div class="col-md-6">
        <div id="main-slider" class="splide mb-3">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php foreach($recipe['images'] as $image) : ?>
                    <li class="splide__slide">
                        <a href="<?= base_url($image['file_path']); ?>" data-lightbox="mainslider">
                            <img class="" src="<?= base_url($image['file_path']); ?>">
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div id="thumbnail-slider" class="splide mb-3">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php foreach($recipe['images'] as $image) : ?>
                        <li class="splide__slide">
                            <img class="" src="<?= base_url($image['file_path']); ?>">
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col">
        <div clas="d-flex align-items-center h-100 p-3 border border-1">
            <span class="">Description :</span>
            <?= $recipe['description']; ?>
        </div>
    </div>
</div>
<!-- START: ETAPES -->
<div class="container-lg">
    <div class="row bg-secondary-subtle py-4">
        <?php if (isset($recipe['steps'])) : ?>
            <?php foreach ($recipe['steps'] as $step) : ?>
                <div class="col-4">
                    <div id="#zone-steps" class="list-group">
                        <a class="list-group-item list-group-item-action" href="#list-step<?= $step['order']; ?>" data-bs-target="#step-<?= $step['order']; ?>" >Étape <?= $step['order']; ?></a>
                    </div>
                </div>
                <div class="col-8">
                    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true"
                         class="scrollspy-example" tabindex="1" data-bs-parent="#zone-steps" >
                        <h4 id="list-step<?= $step['order']; ?>"
                        ></h4>
                        <p class="text" value="steps[<?= $step['order']; ?>][description]"><?= $step['description'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<!-- END: ETAPES -->
    <script>
        $(document).ready(function () {

            /*
            var main = new Splide('#main-slider', {
                type       : 'fade',
                heightRatio: 0.5,
                pagination : false,
                arrows     : false,
                cover      : false, //désactiver "cover" pour éviter le crop
            });
            var thumbnails = new Splide('#thumbnail-slider', {
                rewind       : true,
                fixedWidth   : 80,
                fixedHeight  : 80,
                isNavigation : true,
                gap          : 10,
                focus        : 'center',
                pagination   : false,
                cover        : false,
                breakpoints : {
                    640: {
                        fixedWidth  : 60,
                        fixedHeight : 60,
                    },
                },
            });
            main.sync(thumbnails);
            main.mount();
            thumbnails.mount();
            */

            $('#scoreOpinion').on('mouseenter', '.fa-star', function(){
                var opinion_score = $(this).data('value');
                var current_score = $('#scoreOpinion').data('value');

                // Ne met à jour les classes que si le score change
                if (opinion_score !== current_score) {
                    $('#scoreOpinion').data('value', opinion_score);
                    $('.fa-star').each(function() {
                        if ($(this).data('value') <= opinion_score) {
                            $(this).removeClass('far').addClass('fas');
                        } else {
                            $(this).removeClass('fas').addClass('far');
                        }
                    });
                }
            });
            $('#scoreOpinion').on('click', function(){
                <?php if ($session_user != null) : ?>
                var score = $(this).data('value');
                var name = $('h1').first().text();
                Swal.fire({
                    title: "Validation",
                    text : "Êtes-vous sûr de vouloir mettre " + score + " à " + name + " ?",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Oui !",
                    cancelButtonText: "Non !"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : "<?= base_url('api/recipe/score'); ?>",
                            type : "POST",
                            data : {
                                'score' : score,
                                'id_recipe' : '<?= $recipe['id']; ?>',
                                'id_user' : '<?= $session_user->id ?? ""; ?>',
                            },
                            success : function(response) {
                                console.log(response);
                            }
                        })
                    }
                });
                <?php else : ?>
                swalConnexion();
                <?php endif; ?>
            });
            $('#favorite').on('click', '#heart', function(){
                <?php if ($session_user != null) : ?>
                $.ajax({
                    url : '<?= base_url('api/recipe/favorite'); ?>',
                    type : 'POST',
                    data : {
                        id_user : '<?= $session_user->id ?? ""; ?>',
                        id_recipe : '<?= $recipe['id']; ?>',
                    },
                    success : function(response) {
                        const tooltip = bootstrap.Tooltip.getInstance('#heart');
                        if(response.type == 'delete') {
                            tooltip.setContent({ '.tooltip-inner': 'Ajouter à mes favoris'})
                            $('#favorite .fa-heart').removeClass('fas').addClass('far');
                        } else {
                            tooltip.setContent({ '.tooltip-inner': 'Supprimer de mes favoris'})
                            $('#favorite .fa-heart').removeClass('far').addClass('fas');
                        }
                    }
                })
                <?php else : ?>
                swalConnexion();
                <?php endif; ?>
            });

            function swalConnexion() {
                Swal.fire({
                    title : "Vous n'êtes pas connecté(e) !",
                    text : "Veuillez vous connecter ou vous inscrire.",
                    icon : "warning",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "S'inscrire",
                    denyButtonText: 'Se connecter',
                    cancelButtonText: "Revenir à la recette",
                    confirmButtonColor: "var(--bs-primary)",
                    denyButtonColor: "var(--bs-success)",
                    cancelButtonColor: "var(--bs-secondary)",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        //s'inscrire
                        window.location.href = "<?= base_url('register'); ?>";
                    } else if (result.isDenied) {
                        //se connecter
                        window.location.href = "<?= base_url('sign-in'); ?>";
                    }
                });
            }
        })
    </script>
    <style>
        .fa-star {
            color: var(--bs-warning);
            cursor: pointer;
        }
        .fa-heart:hover {
            scale: 1.1;
            cursor: pointer;
        }
        #heart {
            width: fit-content;
            margin: auto;
        }
    </style>