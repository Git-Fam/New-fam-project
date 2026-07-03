<?php

$function_dir = __DIR__ . '/function/common';

if (is_dir($function_dir)) {
    foreach (glob($function_dir . '/*.php') as $file) {
        require_once $file;
    }
}
