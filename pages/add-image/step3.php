
<div class="row add-image-form">
    <div class="col-lg-6">

        <h4>Step 3: Image information, continued</h4>

        <?php
        $col1Class = "col-lg-4";
        $col2Class = "col-lg-8";
        ?>

        <form method="post" action="./">
            <div class="row form-group">
                <div class="<?=$col1Class?>">Activity</div>
                <div class="<?=$col2Class?>">
                    <select name="activity" class="form-control">
                        <option value="">Please select</option>
                        <option value="flying" <?php if ($imageInfo["activity"] == "flying") echo "selected"; ?>>In flight</option>
                        <option value="perched" <?php if ($imageInfo["activity"] == "perched") echo "selected"; ?>>Perched</option>
                        <option value="crouched" <?php if ($imageInfo["activity"] == "crouched") echo "selected"; ?>>Crouched</option>
                        <option value="in-nest" <?php if ($imageInfo["activity"] == "in-nest") echo "selected"; ?>>In nest</option>
                        <option value="sitting" <?php if ($imageInfo["activity"] == "sitting") echo "selected"; ?>>Sitting</option>
                        <option value="standing" <?php if ($imageInfo["activity"] == "standing") echo "selected"; ?>>Standing</option>
                        <option value="walking" <?php if ($imageInfo["activity"] == "walking") echo "selected"; ?>>Walking</option>
                        <option value="climbing" <?php if ($imageInfo["activity"] == "climbing") echo "selected"; ?>>Climbing</option>
                        <option value="swimming" <?php if ($imageInfo["activity"] == "swimming") echo "selected"; ?>>Swimming</option>
                        <option value="unknown" <?php if ($imageInfo["activity"] == "unknown") echo "selected"; ?>>Unknown</option>
                        <option value="other" <?php if ($imageInfo["activity"] == "other") echo "selected"; ?>>Other</option>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="<?=$col1Class?>">Image content</div>
                <div class="<?=$col2Class?>">
                    <input type="radio" name="imageContent" id="imageContent-full" value="full" <?php if ($imageInfo["imageContent"] == "full") echo "checked"; ?> />
                    <label for="imageContent-full">Full bird</label>
                    <input type="radio" name="imageContent" id="imageContent-face" value="face" <?php if ($imageInfo["imageContent"] == "face") echo "checked"; ?> />
                    <label for="imageContent-face">Face only</label>
                    <input type="radio" name="imageContent" id="imageContent-other" value="other" <?php if ($imageInfo["imageContent"] == "other") echo "checked"; ?> />
                    <label for="imageContent-other">Other</label>
                </div>
            </div>

            <div class="row form-group">
                <div class="<?=$col1Class?>">Bird proximity in image</div>
                <div class="<?=$col2Class?>">
                    <input type="radio" name="proximity" id="proximity-close" value="close" <?php if ($imageInfo["proximity"] == "close") echo "checked"; ?> />
                    <label for="proximity-close">Bird is close-up</label>
                    <input type="radio" name="proximity" id="proximity-mid-range" value="mid-range" <?php if ($imageInfo["proximity"] == "mid-range") echo "checked"; ?> />
                    <label for="proximity-mid-range">Mid-range</label>
                    <input type="radio" name="proximity" id="proximity-far" value="far" <?php if ($imageInfo["proximity"] == "far") echo "checked"; ?> />
                    <label for="proximity-far">Far away</label>
                </div>
            </div>

            <div class="row form-group">
                <div class="<?=$col1Class?>">Identification Difficulty</div>
                <div class="<?=$col2Class?>">
                    <input type="radio" name="idDifficulty" id="idDifficulty-easy" value="easy" <?php if ($imageInfo["idDifficulty"] == "easy") echo "checked"; ?> />
                    <label for="idDifficulty-easy">Easy</label>
                    <input type="radio" name="idDifficulty" id="idDifficulty-okay" value="okay" <?php if ($imageInfo["idDifficulty"] == "okay") echo "checked"; ?> />
                    <label for="idDifficulty-okay">Okay</label>
                    <input type="radio" name="idDifficulty" id="idDifficulty-difficult" value="difficult" <?php if ($imageInfo["idDifficulty"] == "difficult") echo "checked"; ?> />
                    <label for="idDifficulty-difficult">Difficult</label>

                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title=""
                       data-original-title="This is how well the bird can be identified from the image, not how difficult you personally find the bird to ID. Poor or far-off pictures are welcome, as long as the bird is still identifiable."></i>
                </div>
            </div>

            <input type="submit" name="submit" class="btn btn-success" value="Continue &raquo;" />
        </form>

    </div>
    <div class="col-lg-6">
        <div class="image-upload-viewer">
            <img src="<?=AddImage::getImageURL($imageInfo["filename"])?>" />
        </div>
    </div>

</div>

