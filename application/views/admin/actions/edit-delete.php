<?php if ($this->auth->role_id == 1) { ?>

    <?php if ($edit) { ?>
        <span title="edit" class="action-edit badge badge-info link-to" data-to="<?= $edit ?>">
            <i class="fa fa-pencil-square-o"></i>
        </span>
    <?php } ?>

    <?php if ($delete) { ?>
        <span title="delete" class="action-delete badge badge-danger" data-url="<?= $delete ?>" data-message="<?= $deleteMessage ?>">
            <i class="fa fa-trash-o"></i>
        </span>
    <?php } ?>

<?php } ?>