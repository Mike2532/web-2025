<?php 
function short_to_long_id (int $short_id) {
    switch ($short_id) {
        case 1:
            return "67f6e135bd0068.08606824"; //id вани
            break;
        case 2: 
            return "67f6e14c3c9b40.71886685"; //id лизы
            break;  
        default:
            return $short_id;     
    }
}
?>