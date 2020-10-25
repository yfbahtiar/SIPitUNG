<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <div class="mb-3">
                <a href="<?= base_url('menu/submenu'); ?>" class="d-inline badge badge-secondary text-white"><i class="fas fa-angle-left"> Back</i></a>&nbsp;
                <h5 class="d-inline">Edit Submenu</h5>
            </div>

            <form action="<?= base_url('menu/updatesubmenu'); ?>" method="post">
                <div class="form-group row">
                    <input type="hidden" name="id" id="id" value="<?= $submenu['id']; ?>" class="form-cotrol">
                    <label for="name" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" value="<?= $submenu['title']; ?>" required>
                        <?= form_error('title', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Menu_id</label>
                    <div class="col-sm-10">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="<?= $submenu['menu_id']; ?>">== <?= $menuName['menu']; ?> ==</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Url</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="url" name="url" value="<?= $submenu['url']; ?>" required>
                        <?= form_error('url', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="icon" name="icon" value="<?= $submenu['icon']; ?>" required>
                        <?= form_error('icon', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Is Active ?</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <?php if ($submenu['is_active'] == 0) {
                                echo '<input class="form-check-input" type="radio" name="is_active" id="is_ative" value="1"> Active <br>';
                                echo '<input class="form-check-input" type="radio" name="is_active" id="is_ative" value="0" checked> Disabled';
                            } else {
                                echo '<input class="form-check-input" type="radio" name="is_active" id="is_ative" value="1" checked> Active <br>';
                                echo '<input class="form-check-input" type="radio" name="is_active" id="is_ative" value="0"> Disabled';
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->