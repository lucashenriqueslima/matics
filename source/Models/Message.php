<?php
    
    
    namespace Source\Models;

    Class Message extends Model
    {

        
        
        public function findAlerts($id_user)
        {
        
            $query = $this->pdo->prepare("SELECT alerts.link
     , alerts.icon_type
     , alerts.icon
     , alerts.date
     , alerts.message
  FROM alerts
        INNER JOIN access_alerts
            ON alerts.id_alert = access_alerts.id_alert

 WHERE id_sub_user = ? LIMIT 4");

            $query->execute(array($id_user));
            if ($query->rowcount() != 0){
     
                return $query->fetchAll();
            }
             return false;
             
        }
        
        public function msgCounterReset($id_user)
        {
            $query = $this->pdo->prepare("UPDATE sub_users SET msg_count = 0 WHERE id_user = ?");
            $query->execute(array($id_user));
        }
    

    }