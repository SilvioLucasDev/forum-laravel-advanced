<?php

use App\Repositories\PaginationInterface;

if (! function_exists('pagination')) {
    function pagination(PaginationInterface $data)
    {
        return [
            'total' => $data->total(),
            'is_first_page' => $data->isFirstPage(),
            'is_last_page' => $data->isLastPage(),
            'current_page' => $data->currentPage(),
            'next_page' => $data->getNumberNextPage(),
            'previous_page' => $data->getNumberPreviousPage(),
        ];
    }
}
