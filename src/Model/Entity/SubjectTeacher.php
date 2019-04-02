<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubjectTeacher Entity
 *
 * @property int $id
 * @property int $teacher_id
 * @property int $subject_id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created_date
 *
 * @property \App\Model\Entity\Teacher $teacher
 * @property \App\Model\Entity\Subject $subject
 * @property \App\Model\Entity\User $user
 */
class SubjectTeacher extends Entity
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
        'teacher_id' => true,
        'subject_id' => true,
        'user_id' => true,
        'created_date' => true,
        'teacher' => true,
        'subject' => true,
        'user' => true
    ];
}
