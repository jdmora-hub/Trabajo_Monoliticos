<?php

namespace app\models\repositories\historias_respository;

use app\models\entities\Historia;

interface HistoriasRespositoryInterface
{
    public function get_historias(): array;

    public function get_historias_por_sprint(int $sprint_id): array;

    public function save_new_historia(Historia $historia): bool;

    public function update_historia(Historia $historia): bool;

    public function find_historia_by_id(int $id): Historia;

    public function delete_historia(int $id): bool;

    public function get_informe_por_responsable(): array;

    public function get_informe_por_sprint(): array;

    public function get_informe_general(): array;
}
?>