<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;
use Cake\ORM\TableRegistry;
use Cake\View\View;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link https://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
    }
    
         //method that transforms the url into something prety
       public  function GenerateUrl ($s) {
  //Convert accented characters, and remove parentheses and apostrophes
  $from = explode (',', "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,(,),[,],'");
  $to = explode (',', 'c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,,');
  //Do the replacements, and convert all other non-alphanumeric characters to spaces
  $s = preg_replace ('~[^a-zA-Z0-9]+~', '-', str_replace ($from, $to, trim ($s)));
  //Remove a - at the beginning or end and make lowercase
  return strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '', $s)));
}


  //calculate CGPA
    public function calculateCGPA($regnumb) {
        $results_table = TableRegistry::get('Results');
        $courses_table = TableRegistry::get('Subjects');
        $constants_table = TableRegistry::get('Constants');
        $total = 0;
        $totalUnits = 0;
        $results = $results_table->find()->where(['regno' => $regnumb]);
        $l = 0;

        //  debug(json_encode( $results, JSON_PRETTY_PRINT)); exit;
        foreach ($results as $result) {
            $credit_unit = $courses_table->get($result->subject_id);
            $grade_point_quality = $constants_table->find()->where(['name' => $result->grade])->first();
            $course_point = $grade_point_quality->value * $credit_unit->creditload;
            $total += $course_point;
            $totalUnits += $credit_unit->creditload;
            $l++;
        }
        return number_format($total / $totalUnits, 2);
    }
      
     //function that return the grade point value
    public function getgradepoint($course_id,$grade){
        $courses_table = TableRegistry::get('Subjects');
        $constants_table = TableRegistry::get('Constants');
        $credit_unit = $courses_table->get($course_id);
            $grade_point_quality = $constants_table->find()->where(['name' => $grade])->first();
            $course_point = $grade_point_quality->value * $credit_unit->creditload;
            return $course_point;
        
    }

    
}
