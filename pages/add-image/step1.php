<?php if (isset($PAGE["error"]) && $PAGE["error"]) { ?>

    <div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Rats.</strong> <?=$PAGE["errorMessage"]?>
    </div>

<?php } ?>

<div class="row add-image-form">
    <div class="col-lg-6">

        <h4>Step 1: Upload image</h4>

        <form method="post" enctype="multipart/form-data" action="./">
            <div class="well">
                <div class="row">
                    <div class="col-lg-9">
                        <input type="file" id="image" name="image" />
                    </div>
                    <div class="col-lg-3 pull-right">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
