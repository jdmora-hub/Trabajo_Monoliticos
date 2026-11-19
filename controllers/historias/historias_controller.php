<?php

namespace app\controllers\historias;

use app\controllers\mappers\HistoriasMapperController;
use app\models\entities\Historia;
use app\models\repositories\historias_respository\HistoriasRespositoryInterface;

class HistoriasController implements HistoriasControllerInterface
{

    private HistoriasRespositoryInterface $historia_model;

    public function __construct(HistoriasRespositoryInterface $historia_model)
    {
        $this->historia_model = $historia_model;
    }

    public function get_historias_all(): array
    {
        return $this->historia_model->get_historias();
    }

    public function get_historias_por_sprint(int $sprint_id): array
    {
        return $this->historia_model->get_historias_por_sprint($sprint_id);
    }

    public function save_historia(array $request): bool
    {
        $historia = HistoriasMapperController::to_entity($request);
        return $this->historia_model->save_new_historia($historia);
    }

    public function update_historia(array $request): bool
    {
        $historia = HistoriasMapperController::to_entity($request);
        return $this->historia_model->update_historia($historia);
    }

    public function get_historia(int $id): Historia
    {
        return $this->historia_model->find_historia_by_id($id);
    }

    public function delete_historia(int $id): bool
    {
        return $this->historia_model->delete_historia($id);
    }
}
