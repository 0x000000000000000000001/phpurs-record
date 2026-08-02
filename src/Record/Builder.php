<?php

$_copyRecord = function($rec) {
    if (\is_object($rec)) {
        return clone $rec;
    } elseif (\is_array($rec)) {
        return $rec;
    }
    return $rec;
};

$_unsafeInsert = function($l, $a, $rec) {
    if (\is_array($rec)) {
        $rec[$l] = $a;
    } else {
        $rec->{$l} = $a;
    }
    return $rec;
};

$_unsafeModify = function($l, $f, $rec) {
    if (\is_array($rec)) {
        $rec[$l] = $f($rec[$l]);
    } else {
        $rec->{$l} = $f($rec->{$l});
    }
    return $rec;
};

$_unsafeDelete = function($l, $rec) {
    if (\is_array($rec)) {
        unset($rec[$l]);
    } else {
        unset($rec->{$l});
    }
    return $rec;
};

$_unsafeRename = function($l1, $l2, $rec) {
    if (\is_array($rec)) {
        $rec[$l2] = $rec[$l1];
        unset($rec[$l1]);
    } else {
        $rec->{$l2} = $rec->{$l1};
        unset($rec->{$l1});
    }
    return $rec;
};

$exports['copyRecord'] = $_copyRecord;
$exports['unsafeInsert'] = $_unsafeInsert;
$exports['unsafeModify'] = $_unsafeModify;
$exports['unsafeDelete'] = $_unsafeDelete;
$exports['unsafeRename'] = $_unsafeRename;

return $exports;
