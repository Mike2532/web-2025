<?php 
    require __DIR__ . '/../../id_convert.php';

    function get_seeker_id()
        {
            if (isset($_GET['id'])) {
                $seek_id = $_GET['id']; 
                if (filter_var($seek_id, FILTER_VALIDATE_INT, ['min_range' => 1])) {
                    return short_to_long_id($seek_id);
                }
            }
            return -1;
        }
?>