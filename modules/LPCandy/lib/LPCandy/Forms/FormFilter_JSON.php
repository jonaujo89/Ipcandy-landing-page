<?php

namespace LPCandy\Forms;

class FormFilter_JSON {
    function to($str) {
        return json_decode($str);
    }
    function from($val) {
        return json_encode($val);
    }
}