<?php

$_copyRecord = function($rec) {
    if (\is_object($rec)) {
        return clone $rec;
    } elseif (\is_array($rec)) {
        return $rec;
    }
    return $rec;
};

$_unsafeInsert = function($l) {
    return function($a) use ($l) {
        return function($rec) use ($l, $a) {
            if (\is_array($rec)) {
                $rec[$l] = $a;
            } else {
                $rec->{$l} = $a;
            }
            return $rec;
        };
    };
};

$_unsafeModify = function($l) {
    return function($f) use ($l) {
        return function($rec) use ($l, $f) {
            if (\is_array($rec)) {
                $rec[$l] = $f($rec[$l]);
            } else {
                $rec->{$l} = $f($rec->{$l});
            }
            return $rec;
        };
    };
};

$_unsafeDelete = function($l) {
    return function($rec) use ($l) {
        if (\is_array($rec)) {
            unset($rec[$l]);
        } else {
            unset($rec->{$l});
        }
        return $rec;
    };
};

$_unsafeRename = function($l1) {
    return function($l2) use ($l1) {
        return function($rec) use ($l1, $l2) {
            if (\is_array($rec)) {
                $rec[$l2] = $rec[$l1];
                unset($rec[$l1]);
            } else {
                $rec->{$l2} = $rec->{$l1};
                unset($rec->{$l1});
            }
            return $rec;
        };
    };
};

$exports['copyRecord'] = $_copyRecord;
$exports['unsafeInsert'] = $_unsafeInsert;
$exports['unsafeModify'] = $_unsafeModify;
$exports['unsafeDelete'] = $_unsafeDelete;
$exports['unsafeRename'] = $_unsafeRename;

return $exports;
