<?php

namespace app\models\repositories\sprints_respository;

use app\models\database\HistoriasDBInterface;
use app\models\entities\Sprint;
use app\models\mappers\SprintMappers;
use Exception;

class SprintsRespository implements SprintsRespositoryInterface
{
    private HistoriasDBInterface $historias_db;

    public function __construct(HistoriasDBInterface $historias_db)
    {
        $this->historias_db = $historias_db;
    }

    public function get_sprints(): array
    {
        $sql = "select * from sprints order by nombre";
        $sprints_db = $this->historias_db->query_select($sql);
        return array_map(
            fn($row): Sprint => SprintMappers::to_entity($row),
            $sprints_db
        );
    }

    public function save_new_sprint(Sprint $sprint): bool
    {
        $sql = "insert into sprints (nombre, fecha_inicio, fecha_fin) values";
        $sql .= "('" . $sprint->get_nombre() . "', '" . $sprint->get_fecha_inicio() . "', '" . $sprint->get_fecha_fin() . "')";
        return $this->historias_db->query($sql);
    }

    public function update_sprint(Sprint $sprint): bool
    {
        $sql = "update sprints set ";
        $sql .= " nombre='" . $sprint->get_nombre() . "', ";
        $sql .= " fecha_inicio='" . $sprint->get_fecha_inicio() . "', ";
        $sql .= " fecha_fin='" . $sprint->get_fecha_fin() . "' ";
        $sql .= " where id=" . $sprint->get_id();
        return $this->historias_db->query($sql);
    }

    public function find_sprint_by_id(int $id): Sprint
    {
        $sql = "select * from sprints where id=$id";
        $sprints = $this->historias_db->query_select($sql);
        if (count($sprints) == 0) {
            throw new Exception("Sprint no encontrado", 2);
        }
        return SprintMappers::to_entity($sprints[0]);
    }

    public function delete_sprint(int $id): bool
    {
        $sql = "delete from sprints where id=$id";
        return $this->historias_db->query($sql);
    }
}
