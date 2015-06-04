
<div class="row add-image-form">
    <div class="col-lg-6">

        <h4>Step 2: Image information</h4>

        <?php
        $col1Class = "col-lg-4";
        $col2Class = "col-lg-8";
        ?>

        <form method="post" action="./">
            <div class="row form-group">
                <div class="col-lg-11">
                    <input type="hidden" name="numBirds" id="numBirds" value="" />
                    <div id="numBirds-single-btn" class="numBirdsBtn btn <?php if ($imageInfo["numBirds"] !== "single") { ?>btn-unselected<?php } ?>" data-value="single">
                        <i class="fa fa-check-square"></i>
                        <label for="numBirds-single" data-value="single">Single Bird</label>
                    </div>
                    <div id="numBirds-multiple-btn" class="numBirdsBtn btn <?php if ($imageInfo["numBirds"] !== "multiple") { ?>btn-unselected<?php } ?>" data-value="multiple">
                        <i class="fa fa-check-square"></i>
                        <label for="numBirds-multiple" data-value="multiple">Multiple Birds</label>
                    </div>
                </div>
                <div class="col-lg-1">
                    <i class="fa fa-question-circle question-icon" data-container="body" data-toggle="popover" data-placement="left" title=""
                       data-content="If there are many birds in the image but the emphasis is clearly on a single bird, you should select single."></i>
                </div>
            </div>

            <div id="single-bird" class="hidden">
                <div class="row form-group">
                    <div class="col-lg-12">
                        <input type="hidden" name="speciesId" id="speciesId" value="" />
                        <input type="hidden" name="speciesName" id="speciesName" value="" />
                        <input type="text" id="species" name="species" class="form-control" placeholder="Please enter species name" autocomplete="off" />
                    </div>
                </div>
            </div>

            <div id="multiple-birds" class="hidden">
                <div class="row form-group">
                    <div class="<?=$col1Class?>">All the same species?</div>
                    <div class="<?=$col2Class?>">
                        <input type="radio" name="gender" id="same-species-yes" />
                        <label for="same-species-yes">Yes</label>
                        <input type="radio" name="gender" id="same-species-no" />
                        <label for="same-species-no">No</label>
                    </div>
                </div>
            </div>

            <div id="single-birds-extra-questions" class="hidden">
                <div class="panel panel-default form-group">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-2">Gender</div>
                            <div class="col-lg-4">
                                <ul>
                                    <li>
                                        <input type="radio" name="gender" id="gender-male" value="male" />
                                        <label for="gender-male">Male</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="gender" id="gender-female" value="female" />
                                        <label for="gender-female">Female</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="gender" id="gender-unknown" value="unknown" />
                                        <label for="gender-unknown">Unknown</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-2">Age</div>
                            <div class="col-lg-4">
                                <ul>
                                    <li>
                                        <input type="radio" name="age" id="age-juvenile" />
                                        <label for="age-juvenile">Juvenile</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="age" id="age-immature" />
                                        <label for="age-immature">Immature</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="age" id="age-adult" />
                                        <label for="age-adult">Adult</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="extra-questions" class="hidden">
                <div class="panel panel-default form-group">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 three-cols">
                                <?= Images::getImageTagCheckboxes(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn btn-success" value="Continue &raquo;" />
            </div>

        </form>


    </div>
    <div class="col-lg-6">
        <div class="image-upload-viewer">
            <img src="<?=AddImage::getImageURL($imageInfo["filename"])?>" />
        </div>
    </div>

</div>

