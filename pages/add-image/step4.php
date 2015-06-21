
<div class="row">
    <div class="col-lg-6">

        <?php
        $col1Class = "col-lg-3";
        $col2Class = "col-lg-9";
        ?>

        <form action="./" method="post">
            <div class="row form-group">
                <div class="<?=$col1Class?>">Lat</div>
                <div class="<?=$col2Class?>">
                    <input type="text" name="lat" value="" class="form-control "/>
                </div>
            </div>
            <div class="row form-group">
                <div class="<?=$col1Class?>">Lng</div>
                <div class="<?=$col2Class?>">
                    <input type="text" name="lng" value="" class="form-control "/>
                </div>
            </div>
            <!--
            <div class="row form-group">
                <div class="<?=$col1Class?>">Date Taken</div>
                <div class="<?=$col2Class?>">
                    <div class="input-group date" id="datetimepicker1">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            -->
            <input type="submit" name="submit" class="btn btn-success" value="Complete &raquo;" />
        </form>


    </div>
    <div class="col-lg-6">
        <div class="image-upload-viewer">
            <img src="<?=AddImage::getImageURL($imageInfo["filename"])?>" />
        </div>
    </div>

</div>

