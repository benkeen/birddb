        <footer>
            <div class="row">
            </div>
        </footer>

    </div>

    <script src="<?=$ENV["relativeRoot"]?>/resources/js/jquery-1.10.2.min.js"></script>
    <script src="<?=$ENV["relativeRoot"]?>/resources/js/underscore-min.js"></script>
    <script src="<?=$ENV["relativeRoot"]?>/resources/js/bootstrap.min.js"></script>
    <?php

    if (isset($PAGE["js"])) {
        $jsArr = $PAGE["js"];
        if (!is_array($jsArr)) {
            $jsArr = array($jsArr);
        }
        foreach ($jsArr as $js) {
            echo "<script src=\"{$ENV["relativeRoot"]}/$js\"></script>\n";
        }
    }
    ?>

</body>
</html>
