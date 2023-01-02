<?php

namespace SmartSolucoes\Model;

use SmartSolucoes\Core\Model;
use SmartSolucoes\Libs\Helper;

class Calendario extends Model
{

    public function allCalendar()
    {
        $sql = "
          SELECT c.*,
          FROM calendar c 
          LEFT JOIN user u ON c.user_id = u.id
        ";
        $query = $this->PDO()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

  public function createCalendar($user, $date, $task, $user_id)

    {
        $sql = "
        INSERT INTO `calendario` (usuario, data_agendamento, tarefa, user_id)
        VALUES (
          '{$user}', '{$date}' , '{$task}', '{$user_id}'
        );
        ";
        $query = $this->PDO()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function updateCalendar($id, $user, $date, $task, $user_id)
      {
          $sql = "
            UPDATE calendrio
            SET usuario = '{$user}'
            SET data_agendamento = '{$date}'
            SET tarefa = '{$task}'
            SET user_id = '{$user_id}'
            where id = {$id}; 
          ";
          $query = $this->PDO()->prepare($sql);
          $query->execute();
          return $query->fetchAll();
    }

    public function deleteCalendar($id)
    {
        $sql = "
          DELETE FROM calandario
          where c.id = {$id};
        ";
        $query = $this->PDO()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
  }

}
