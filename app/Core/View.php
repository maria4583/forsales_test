<?php

namespace Core;

trait View
{
    /**
     * Find and return page by filename
     *
     * @param string $filename
     * @throws \Exception
     */
    public function view(string $filename)
    {
        $path = config('ROOT_PATH') . config('DS') . 'resources' . config('DS')
            . 'views' . config('DS') . $filename . '.html';

        if (!file_exists($path)) {
            throw new \Exception('View not found');
        }

        include_once $path;
    }
}