<?php
require_once("func.php");

$formats = "jpg,gif,png,jpeg,svg,webp";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pepper Print This:</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <nav id="filterNav">
        <ul class="nav">
            <li data-filter="*"><a href="#"><small>(<?= totalImages($formats) ?>)</small><br>All</a></li>
            <?php
            foreach(glob("images/*", GLOB_ONLYDIR) as $category) {
                $cat = str_replace("images/", "", $category);
                if(count(glob($category."/*", GLOB_ONLYDIR)) > 0) {
                    echo '<li><a href="#" data-filter=".'.$cat.'"><small>('.subCount($category, $formats).')</small><br>'.ucwords(str_replace("-", " ", $cat)).'</a>
                    <ul>';
                    foreach(glob($category."/*", GLOB_ONLYDIR) as $subcategory) {
                        $subcat = str_replace($category."/", "", $subcategory);
                        $count = count(glob($subcategory."/*.{".$formats."}", GLOB_BRACE));
                        echo '<li><a href="#" data-filter=".'.$subcat.'">'.$count.'. '.ucwords(str_replace("-", " ", $subcat)).'</a></li>'; 
                    }
                    echo '</ul>
                    </li>';
                } else {
                    $count = count(glob($category."/*.{".$formats."}", GLOB_BRACE));
                    echo '<li><a href="#" data-filter=".'.$cat.'"><small>('.$count.')</small><br>'.ucwords(str_replace("-", " ", $cat)).'</a></li>';
                }
            }
            ?>
        </ul>
        </nav>

        <div class="list">
            <?php
            foreach(glob("images/*", GLOB_ONLYDIR) as $category) {
                $cat = str_replace('images/', '', $category);
                foreach(glob($category."/*.{".$formats."}", GLOB_BRACE) as $file) {
                    echo '<div class="item '.$cat.'">
                    <a href="#" onclick="printJS(\''.$file.'\', \'image\');return false;"><img src="'.$file.'"></a>
                </div>';
                }
                foreach(glob($category."/*", GLOB_ONLYDIR) as $subcategory) {
                    $subcat = str_replace($category.'/', '', $subcategory);
                    
                    foreach(glob($subcategory."/*.{".$formats."}", GLOB_BRACE) as $subfile) {

                        echo '<div class="item '.$cat.' '.$subcat.'">
                        <a href="#" onclick="printJS(\''.$subfile.'\', \'image\');return false;"><img src="'.$subfile.'"></a>
                    </div>';
                    }
                }
            }
            ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="functions.js"></script>
</body>
</html>