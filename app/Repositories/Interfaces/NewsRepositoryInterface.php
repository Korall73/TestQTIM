<?php

namespace App\Repositories\Interfaces;

interface NewsRepositoryInterface
{
    public function all(): object;
    public function show(string $id): object;
    public function create(object $request): object;
    public function update(object $request, string $id): object;
    public function delete(string $id): object;
}