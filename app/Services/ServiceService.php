<?php

namespace App\Services;

use App\Models\Service;

class ServiceService
{
    public function getAllService()
    {
        return Service::query()->with('category')->orderBy('created_at', 'desc')->paginate(10);
    }
}
