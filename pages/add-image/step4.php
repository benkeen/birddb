
<div class="row">
    <div class="col-lg-6">

        <?php
        $col1Class = "col-lg-3";
        $col2Class = "col-lg-9";
        ?>

        <form>
            <div class="row">
                <div class="<?=$col1Class?>">Location</div>
                <div class="<?=$col2Class?>">

                </div>
            </div>
            <div class="row">
                <div class="<?=$col1Class?>">Date Taken</div>
                <div class="<?=$col2Class?>">

                </div>
            </div>
            <div class="row">
                <div class="<?=$col1Class?>">Author</div>
                <div class="<?=$col2Class?>">
                </div>
            </div>

        </form>


    </div>
    <div class="col-lg-6">
        <div class="imageUploadViewer">
            <img src="<?=$PAGE["imageRelativePath"]?>" />
        </div>
    </div>

</div>

