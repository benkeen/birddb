<?php


$lines = file("taxonomy.csv");

// TAXON_ORDER,CATEGORY,SPECIES_CODE,SCI_NAME,PRIMARY_COM_NAME,ORDER1,FAMILY

foreach ($lines as $line) {
    list($numericOrder, $category, $speciesCode, $sciName, $commonName, $taxonomyOrder, $family) = explode(",", trim($line));

    $taxonomyOrder = mysql_real_escape_string($taxonomyOrder);
    $category = mysql_real_escape_string($category);
    $speciesCode = mysql_real_escape_string($speciesCode);
    $sciName = mysql_real_escape_string($sciName);
    $commonName = mysql_real_escape_string($commonName);
    $order = mysql_real_escape_string($order);
    $family = mysql_real_escape_string($family);

    echo "INSERT INTO species (numericOrder, category, speciesCode, sciName, commonName, taxonomyOrder, family) "
     . "VALUES ('$numericOrder', '$category', '$speciesCode', '$sciName', '$commonName', '$taxonomyOrder', '$family');\n";
}

