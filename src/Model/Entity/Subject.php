<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subject Entity
 *
 * @property int $id
 * @property string $name
 * @property string $subjectcode
 * @property int $department_id
 * @property int $creditload
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created_date
 * @property int $status
 *
 * @property \App\Model\Entity\Department[] $departments
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Topic[] $topics
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\Teacher[] $teachers
 */
class Subject extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'subjectcode' => true,
        'department_id' => true,
        'creditload' => true,
        'user_id' => true,
        'created_date' => true,
        'status' => true,
        'departments' => true,
        'user' => true,
        'topics' => true,
        'students' => true,
        'teachers' => true
    ];
}
