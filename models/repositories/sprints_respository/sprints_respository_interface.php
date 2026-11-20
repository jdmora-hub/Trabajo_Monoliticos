<?php

namespace app\models\repositories\sprints_respository;

use app\models\entities\Sprint;

interface SprintsRespositoryInterface
{
    public function get_sprints(): array;

    public function save_new_sprint(Sprint $sprint): bool;

    public function update_sprint(Sprint $sprint): bool;

    public function find_sprint_by_id(int $id): Sprint;

    public function delete_sprint(int $id): bool;
}
?>