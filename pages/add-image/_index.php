<?php

if (!empty($_FILES)) {
    $imageId = Images::insertBlankImageRow();

    $uploadDir = realpath(__DIR__ . "/../../uploads/tmp/");
    $oldFilename = $_FILES['image']['name'];
    $newFilename = $imageId . "." . Files::getFilenameExtension($oldFilename);
    $newFilenameAndPath = $uploadDir . "/" . $newFilename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $newFilenameAndPath)) {
        $PAGE["step"] = 2;
        $PAGE["imageRelativePath"] = $ENV["relativeRoot"] . "/uploads/tmp/" . $newFilename;
    } else {
        $PAGE["error"] = true;
        $PAGE["errorMessage"] = "There was a problem uploading the image. Hmm. This shouldn't have happened. Better contact Ben.";
    }
}

