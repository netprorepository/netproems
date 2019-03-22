<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property string $type
 * @property string $description
 * @property int $regfee
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $invoiceprefix
 * @property string $adminprefix
 * @property string $logo
 * @property string $staffprefix
 */
class Setting extends Entity
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
        'type' => true,
        'description' => true,
        'regfee' => true,
        'name' => true,
        'address' => true,
        'email' => true,
        'phone' => true,
        'invoiceprefix' => true,
        'adminprefix' => true,
        'logo' => true,
        'staffprefix' => true
    ];
}
