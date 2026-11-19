<?php

namespace app\controllers\historias;

use app\models\entities\Historia;

interface HistoriasControllerInterface
{
    public function get_historias_all(): array;

    public function get_historias_por_sprint(int $sprint_id): array;

    public function save_historia(array $request): bool;

    public function update_historia(array $request): bool;

    public function get_historia(int $id): Historia;

    public function delete_historia(int $id): bool;
}
