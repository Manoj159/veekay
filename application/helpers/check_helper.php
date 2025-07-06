<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


function check_booking($res, $search_start, $search_end){
	 foreach ($res as $data) {
        $start = new DateTime($data->start);
        $end = new DateTime($data->end);
        $searchStart = new DateTime($search_start);
        $searchEnd = new DateTime($search_end);

        if ($start <= $searchEnd && $searchStart <= $end) {
            return 1;
        }
    
	}
 return 0;
}


?>