<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry; 


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of topjobs
 *
 * @author Administrator
 */
class nemsCell extends Cell{
    
    public function display(){
        
        //cell method for most viewed/popular news in the past three weeks
        $jobtable = TableRegistry::get('Jobs');
        $jobs =  $jobtable->find('all')
         ->where(['DATE(post_date) > DATE(DATE_SUB(NOW(), INTERVAL 31 DAY))','approvalstatus' => 'approved'])
           ->order(['job_view_count' => 'desc'])
           ->limit(40);
              
        $this->set('trendingjobs',  $jobs);
    }

    
    
    //cell that renders notification
    public function getnotifications(){
         $notification_table = TableRegistry::get('Notifications');
         $notifications = $notification_table->find()
                 ->where(['status'=>'Active'])
                 ->order(['datecreated'=>'DESC'])
                 ->limit(3);
         $this->set('notifications',  $notifications);
    }
          
    
    //cell that renders user activities to the admin
    public function useractivities(){
        
        $logs_table = TableRegistry::get('Logs');
        $logs = $logs_table->find()->contain(['Users'])->order(['timestamp'=>'DESC'])->limit(10);
         $this->set('logs',  $logs);
    }
}
