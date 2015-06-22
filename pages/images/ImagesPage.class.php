<?php

class ImagesPage {

    public static function init() {
        global $ENV;
    }

    public static function generatePagination($currentPage, $perPage, $numResults) {
        echo "<nav><ul class=\"pagination\">";

        $prevClass = ($currentPage > 1) ? "" : "disabled";
        $prevPage = $currentPage - 1;
        echo "<li class=\"$prevClass\"><a href=\"?page=$prevPage\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";

        $numPages = ceil($numResults / $perPage);
        for ($i=1; $i<=$numPages; $i++) {
            $linkClass = ($i == $currentPage) ? "active" : "";
            echo "<li class=\"$linkClass\"><a href=\"?page={$i}\">$i</a></li>";
        }

        $nextClass = ($currentPage == $numPages) ? "disabled" : "";
        $nextPage = $currentPage + 1;
        echo "<li class=\"$nextClass\"><a href=\"?page=$nextPage\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>";

        echo "</ul></nav>";
    }
}
