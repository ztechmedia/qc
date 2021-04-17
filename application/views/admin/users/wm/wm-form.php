<div class="form-group">
    <label class="col-md-3 control-label">Nama</label>
    <div class="col-md-6">
        <input name="nama" id="nama" type="text" class="validate[required,maxSize[30]] form-control" value="<?= $user ? $user->nama : "" ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Username</label>
    <div class="col-md-6">
        <input name="username" id="username" type="text" class="validate[required,,maxSize[50]] form-control" value="<?= $user ? $user->username : "" ?>" />
        <span class="help-block form-error" id="username-error"></span>
    </div>
</div>

<?php if ($this->auth->role_id == 1) { ?>
    <div class="form-group">
        <label class="col-md-3 control-label">Level</label>
        <div class="col-md-6">
            <select class="validate[required] select" name="level" id="level">
                <option value="">Pilih Hak Akses</option>
                <?php foreach ($levels as $level) {
                    $selected = null;
                    if ($user && $level->level === $user->level) {
                        $selected = 'selected';
                    }
                    echo "<option $selected value=" . $level->level . " >$level->level</option>";
                } ?>
            </select>
        </div>
    </div>
<?php } ?>