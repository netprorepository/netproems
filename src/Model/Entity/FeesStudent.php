<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeesStudent Entity
 *
 * @property int $id
 * @property int $fee_id
 * @property int $student_id
 *
 * @property \App\Model\Entity\Fee $fee
 * @property \App\Model\Entity\Student $student
 */
class FeesStudent extends Entity
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
        'fee_id' => true,
        'student_id' => true,
        'fee' => true,
        'student' => true
    ];
}
