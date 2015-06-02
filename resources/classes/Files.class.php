<?php

class Files {

    /**
     * Simple helper function to return the extension of a file.
     *
     * @param string $filename
     * @return string
     */
    public static function getFilenameExtension($filename, $lowercase = false) {
        $sections = explode(".", $filename);
        $extension = ($lowercase) ? mb_strtolower($sections[count($sections) - 1]) : $sections[count($sections) - 1];
        return $extension;
    }

}
