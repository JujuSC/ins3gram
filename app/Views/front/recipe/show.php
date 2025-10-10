<div class="row">
    <div class="col">
        <div class="position-relative">
            <?php if(isset($recipe['mea']['file_path'])) : ?>
                <img src="<?= base_url($recipe['mea']['file_path']); ?>" class="img-fluid recipe-img-mea">
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
    <div class="col-md-3">
        <div class="row">
            <div class="col">
                <div class="row row-cols-2 my-2">
                    <div class="col">
                        <span class="fas fa-star" data-star="1"></span>
                        <span class="fas fa-star" data-star="2"></span>
                        <span class="fas fa-star" data-star="3"></span>
                        <span class="fas fa-star" data-star="4"></span>
                        <span class="fas fa-star" data-star="5"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        BOUTON LIEN
    </div>
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
        var main = new Splide('#main-slider', {
            type : 'fade',
            heightRatio : 0.5,
            pagination : false,
            arrows : false,
            cover : false, //désactiver 'cover' pour eviter le crop
        });
        var thumbnails = new Splide('#thumbnail-slider', {
            rewind : true,
            fixedWidth : 80,
            fixedHeight : 80,
            isNavigation : true,
            gap : 10,
            focus : 'center',
            pagination : false,
            cover : false,
            breakpoints : {
                640: {
                    fixedWidth : 60,
                    fixedHeight : 60,
                },
            },
        });
        main.sync(thumbnails);
        main.mount();
        thumbnails.mount();
    })
</script>