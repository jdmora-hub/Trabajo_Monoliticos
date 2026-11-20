<?php

namespace app\controllers\informes;

use app\models\repositories\historias_respository\HistoriasRespositoryInterface;

class InformesController implements InformesControllerInterface
{

    private HistoriasRespositoryInterface $historia_model;

    public function __construct(HistoriasRespositoryInterface $historia_model)
    {
        $this->historia_model = $historia_model;
    }

    public function get_informe_por_responsable(): array
    {
        return $this->historia_model->get_informe_por_responsable();
    }

    public function get_informe_por_sprint(): array
    {
        return $this->historia_model->get_informe_por_sprint();
    }

    public function get_informe_general(): array
    {
        return $this->historia_model->get_informe_general();
    }
}
?>