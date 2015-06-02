
<div class="row">
    <div class="col-lg-6">

        <?php
        $col1Class = "col-lg-3";
        $col2Class = "col-lg-9";
        ?>

        <form>
            <div class="row form-group">
                <div class="<?=$col1Class?>">Image Quality</div>
                <div class="col-lg-7">
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-very-easy" />
                    <label for="identificationDifficulty-very-easy">Very Easy</label>
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-easy" />
                    <label for="identificationDifficulty-easy">Easy</label>
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-medium" />
                    <label for="identificationDifficulty-medium">Medium</label>
                </div>
                <div class="col-lg-1">
                    <i class="fa fa-question-circle question-icon" data-container="body" data-toggle="popover" data-placement="left" title=""
                       data-content="The overall quality of the image."></i>
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
                <div class="col-lg-10">
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-very-easy" />
                    <label for="idenfificationDifficulty-very-easy">Very Easy</label>
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-easy" />
                    <label for="idenfificationDifficulty-easy">Easy</label>
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-medium" />
                    <label for="idenfificationDifficulty-medium">Medium</label>
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-hard" />
                    <label for="idenfificationDifficulty-hard">Hard</label>
                    <input type="radio" name="identificationDifficulty" id="idenfificationDifficulty-very-hard" />
                    <label for="idenfificationDifficulty-very-hard">Very Hard</label>

                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title=""
                       data-original-title="This is how well the bird can be identified by the quality of the image, not how difficult you find the bird to ID. Poor or far-off pictures are welcome, as long as the bird is still identifiable."></i>
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

