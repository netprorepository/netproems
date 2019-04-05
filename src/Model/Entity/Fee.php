<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fee Entity
 *
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property int $user_id
 * @property int $status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Feeallocation[] $feeallocations
 * @property \App\Model\Entity\Department[] $departments
 */
class Fee extends Entity
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
        'amount' => true,
        'user_id' => true,
        'status' => true,
        'user' => true,
        'feeallocations' => true,
        'startdate'=> true,
        'enddate' => true,
        'departments' => true
    ];
}
