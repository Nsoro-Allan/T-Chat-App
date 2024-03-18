<?php
    // Calculate time difference
    $current_time = time();
    $post_time = strtotime($post_date);
    $time_difference = $current_time - $post_time;

    // Format the time difference
    if ($time_difference < 60) {
        $formatted_time = $time_difference . 's'; // seconds
    } elseif ($time_difference < 3600) {
        $formatted_time = floor($time_difference / 60) . 'm'; // minutes
    } elseif ($time_difference < 86400) {
        $formatted_time = floor($time_difference / 3600) . 'hrs'; // hours
    } elseif ($time_difference < 604800) {
        $formatted_time = floor($time_difference / 86400) . 'd'; // days
    } elseif ($time_difference < 2419200) {
        $formatted_time = floor($time_difference / 604800) . 'w'; // weeks
    } elseif ($time_difference < 29030400) {
        $formatted_time = floor($time_difference / 2419200) . 'months'; // months
    } else {
        $formatted_time = floor($time_difference / 29030400) . 'yrs'; // years
    }
?>