<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Programe Entity
 *
 * @property int $id
 * @property int $department_id
 * @property string $programecode
 * @property string $name
 *
 * @property \App\Model\Entity\Department $department
 */
class Programe extends Entity
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
        'department_id' => true,
        'programecode' => true,
        'name' => true,
        'department' => true
    ];
}
