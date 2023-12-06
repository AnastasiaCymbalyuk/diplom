<?php

namespace App\Services\Ticket;
use App\Models\Ticket;

class Service
{
    public function index()
    {
        $ticket = Ticket::all();
        return $ticket;
    }

    public function store($data)
    {
        Ticket::create($data);
    }
}