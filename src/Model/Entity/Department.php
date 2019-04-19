<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Department Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created_date
 * @property int $faculty_id
 * @property string $deptcode
 *
 * @property \App\Model\Entity\Faculty $faculty
 * @property \App\Model\Entity\Dstudent[] $dstudents
 * @property \App\Model\Entity\Feeallocation[] $feeallocations
 * @property \App\Model\Entity\Programe[] $programes
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\Subject[] $subjects
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Fee[] $fees
 */
class Department extends Entity
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
        'description' => true,
        'created_date' => true,
        'faculty_id' => true,
        'deptcode' => true,
        'faculty' => true,
        'dstudents' => true,
        'feeallocations' => true,
        'programes' => true,
        'students' => true,
        'subjects' => true,
        'users' => true,
        'fees' => true
    ];
}
