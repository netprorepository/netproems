<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sparent Entity
 *
 * @property int $id
 * @property string $fathersname
 * @property string $mothersname
 * @property string $fatherphone
 * @property string $motherphone
 * @property string $fathersjob
 * @property string $mothersjob
 * @property int $pemailaddress
 *
 * @property \App\Model\Entity\Student[] $students
 */
class Sparent extends Entity
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
        'fathersname' => true,
        'mothersname' => true,
        'fatherphone' => true,
        'motherphone' => true,
        'fathersjob' => true,
        'mothersjob' => true,
        'pemailaddress' => true,
        'user_id' => true,
        'user' => true,
        'students' => true
    ];
}
