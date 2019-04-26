<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $mname
 * @property string $dob
 * @property \Cake\I18n\FrozenTime $joindate
 * @property int $department_id
 * @property string $olevelresulturl
 * @property int $jamb
 * @property string $birthcerturl
 * @property string $othercerts
 * @property string $email
 * @property int $state_id
 * @property int $country_id
 * @property string $address
 * @property string $phone
 * @property string $fathersname
 * @property string $mothersname
 * @property string $fatherphone
 * @property string $motherphone
 * @property string $fathersjob
 * @property string $mothersjob
 * @property string $passporturl
 * @property int $user_id
 * @property string $regno
 * @property string $status
 * @property string $admissiondate
 *
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Fee[] $fees
 * @property \App\Model\Entity\Subject[] $subjects
 */
class Student extends Entity
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
        'fname' => true,
        'lname' => true,
        'mname' => true,
        'dob' => true,
        'joindate' => true,
        'department_id' => true,
        'olevelresulturl' => true,
        'jamb' => true,
        'birthcerturl' => true,
        'othercerts' => true,
        'email' => true,
        'state_id' => true,
        'country_id' => true,
        'address' => true,
        'phone' => true,
        'level_id' => true,
        'fathersname' => true,
        'mothersname' => true,
        'fatherphone' => true,
        'motherphone' => true,
        'fathersjob' => true,
        'mothersjob' => true,
        'passporturl' => true,
        'user_id' => true,
        'regno' => true,
        'status' => true,
        'admissiondate' => true,
        'department' => true,
        'state' => true,
        'level' => true,
        'country' => true,
        'user' => true,
        'fees' => true,
        'gender' => true,
        'subjects' => true
    ];
}
