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

  public function createCalendar($date, $title, $id_update_user)

    {
        $sql = "
        INSERT INTO `calendario` (data_agendamento, titulo, id_update_user)
        VALUES (
          '{$date}' , '{$title}, '{$id_update_user}'
        );
        ";
        $query = $this->PDO()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function updateCalendar($id, $user, $date, $title, $user_id)
      {
          $sql = "
            UPDATE calendrio
            SET data_agendamento = '{$date}'
            SET titulo = '{$title}'
            SET id_update_user = '{$user_id}'
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
