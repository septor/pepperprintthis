<?php
function totalImages($formats) {
    $totalImages = 0;
    foreach(glob("./images/*", GLOB_ONLYDIR) as $category) {
        $totalImages += count(glob($category."/*.{".$formats."}", GLOB_BRACE));
        foreach(glob($category."/*", GLOB_ONLYDIR) as $subcategory) {
            $totalImages += count(glob($subcategory."/*.{".$formats."}", GLOB_BRACE));
        }
    }
    return $totalImages;
}
function subCount($cat, $formats) {
    $catCount = 0;
    foreach(glob($cat.'/*', GLOB_ONLYDIR) as $subcategory) {
        $catCount += count(glob($subcategory."/*.{".$formats."}", GLOB_BRACE));
    }
    return $catCount;
}