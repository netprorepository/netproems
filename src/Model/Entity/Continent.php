<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Continent Entity
 *
 * @property string $code
 * @property string $name
 * @property int $id
 * @property int $cost
 *
 * @property \App\Model\Entity\Trequest[] $trequests
 */
class Continent extends Entity
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
        'code' => true,
        'name' => true,
        'cost' => true,
        'trequests' => true
    ];
}
