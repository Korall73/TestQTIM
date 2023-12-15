<?php

namespace App\Repositories\Interfaces;

interface NewsRepositoryInterface
{
    public function all();
    public function show(string $id);
    public function create(object $request);
    public function update(object $request, string $id);
    public function delete(string $id);
}