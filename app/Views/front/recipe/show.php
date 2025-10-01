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
        NOTE
    </div>
    <div class="col-md-9">
        BOUTON LIEN
    </div>
</div>
<!--START: TAGS-->
<div class="row">
    <div class="col">
        <div class="container text-center">
            <?php foreach($recipe['tags'] as $tag) : ?>
            <div class="row row-cols-auto">
                <div class="col">
                    <span class="bg-black text-white border"><?= $tag['name'] ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- END: TAGS-->
<!-- START :INGREDIENTS-->
<div class="row">
    <div class="col">
        <div class="container text-center">
            <?php foreach($recipe['ingredients'] as $ingredient) : ?>
            <div class="row row-cols-4 mb-3">
                <div class="col"><?= $ingredient['quantity'] ?></div>
                <?php endforeach; ?>
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
<div class="row">
    <div class="col-4">
        <div id="list-example" class="list-group">
            <?php foreach($recipe['steps'] as $step) :?>
            <a class="list-group-item list-group-item-action" href="#list-item-<?= $step['order'] ?>">Etape <?= $step['order'] ?></a>
        </div>
    </div>
    <div class="col-8">
        <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">

            <h4 id="list-item-<?= $step['order'] ?>"><?= $step['order'] ?></h4>
            <p><?= $step['description'] ?></p>
            <?php endforeach; ?>
        </div>
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