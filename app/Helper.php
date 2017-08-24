<?php

if (!function_exists('translug')){
    function translug($slug){
        return app('translug')->translate($slug);
    }
}