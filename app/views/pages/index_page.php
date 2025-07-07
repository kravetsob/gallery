<header>
    <h1><a href="../index.php">Gallery</a></h1>
</header>
<main>
    <?php if(!empty($success)):?>
    <div id="upload-success" class="message success <?= $success ? '' : 'hide' ?>">
        Файл успішно завантажено!
        <div class="close-btn">&times;</div>
    </div>
    <?php endif;?>
    <?php if(!empty($errors)):?>
    <div id="upload-errors" class="message error <?= ($errors) ? '' : 'hide' ?>">
        <div class="close-btn">&times;</div>
        <?= implode('<br>', $errors) ?>
    </div>
    <?php endif;?>
    <div class="photo-container">
        <div class="arrow right-arrow">&#8594;</div>
        <div id="gallery" data-images='<?= $photoNamesJson ?>' class="image-container ">
            <img id="image" src="/images/<?= ($photos[0]['name'] ?? '') ?>" alt="">
        </div>
        <div class="arrow left-arrow">&#8592;</div>
    </div>
    <form class="upload" action="<?= \app\core\Route::url('index','add')?>" method="post" enctype="multipart/form-data">
        <label for="image-upload">Вибрати:</label>
        <input type="file" id="image-upload" name="photo"/>
        <input type="submit" value="Ок">
    </form>
</main>