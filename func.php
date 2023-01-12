<?php
function totalImages() {
    $totalImages = 0;
    foreach(glob("./images/*", GLOB_ONLYDIR) as $category) {
        $totalImages += count(glob($category."/*.{jpg,gif,png,jpeg,svg,webp}", GLOB_BRACE));
        foreach(glob($category."/*", GLOB_ONLYDIR) as $subcategory) {
            $totalImages += count(glob($subcategory."/*.{jpg,gif,png,jpeg,svg,webp}", GLOB_BRACE));
        }
    }
    return $totalImages;
}
function subCount($cat) {
    $catCount = 0;
    foreach(glob($cat.'/*', GLOB_ONLYDIR) as $subcategory) {
        $catCount += count(glob($subcategory."/*.{jpg,gif,png,jpeg,svg,webp}", GLOB_BRACE));
    }
    return $catCount;
}