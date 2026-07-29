<?php

$_unsafeUnionFn = function($r1, $r2) {
    $copy = [];
    
    if (\is_object($r2)) {
        foreach (get_object_vars($r2) as $k => $v) {
            $copy[$k] = $v;
        }
    } elseif (\is_array($r2)) {
        foreach ($r2 as $k => $v) {
            $copy[$k] = $v;
        }
    }

    if (\is_object($r1)) {
        foreach (get_object_vars($r1) as $k => $v) {
            $copy[$k] = $v;
        }
    } elseif (\is_array($r1)) {
        foreach ($r1 as $k => $v) {
            $copy[$k] = $v;
        }
    }
    
    return $copy;
};

$exports['unsafeUnionFn'] = $_unsafeUnionFn;

return $exports;
