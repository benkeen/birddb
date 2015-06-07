
<div class="row add-image-form">
    <div class="col-lg-6">

        <h4>Step 3: Image information, continued</h4>

        <?php
        $col1Class = "col-lg-3";
        $col2Class = "col-lg-9";
        ?>

        <form method="post" action="./">
            <div class="panel panel-default form-group">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="radio" name="activity" id="activity-in-flight" />
                            <label for="activity-in-flight">In flight</label>
                            <input type="radio" name="activity" id="activity-sitting" />
                            <label for="activity-sitting">Sitting / Perched</label>
                            <input type="radio" name="activity" id="activity-swimming" />
                            <label for="activity-swimming">Swimming</label>
                            <input type="radio" name="activity" id="activity-other" />
                            <label for="activity-other">Other</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="<?=$col1Class?>">Bird proximity in image</div>
                <div class="<?=$col2Class?>">
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-very-easy" />
                    <label for="idenfificationDifficulty-very-easy">Bird is close-up</label>
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-easy" />
                    <label for="idenfificationDifficulty-easy">Mid-range</label>
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-medium" />
                    <label for="idenfificationDifficulty-medium">Bird is far away</label>
                </div>
            </div>

            <div class="row form-group">
                <div class="<?=$col1Class?>">Identification Difficulty</div>
                <div class="col-lg-8">
                    <select class="form-control">
                        <option value="">Please select</option>
                    </select>
                </div>
                <div class="col-lg-1">
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title=""
                       data-original-title="This is how well the bird can be identified by the quality of the image, not how difficult you find the bird to ID. Poor or far-off pictures are welcome, as long as the bird is still identifiable."></i>
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

