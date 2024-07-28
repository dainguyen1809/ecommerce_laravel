<?php

function breadcrumbs()
{
    // Ví dụ để phân tách url thành các phần
    $path = request()->path();
    $segments = explode('/', $path);

    // Thay thế 'show/{id}' bằng 'details'
    foreach ($segments as $index => $segment) {
        if ($segment === 'show' && isset($segments[$index + 1]) && is_numeric($segments[$index + 1])) {
            $segments[$index] = 'details';
            unset($segments[$index + 1]);
        } else {
            $segments[$index] = str_replace('-', ' ', $segment); // chuyển đổi dấu gạch ngang thành khoảng trắng
        }
    }

    return array_values($segments); // reset lại các key của mảng
}