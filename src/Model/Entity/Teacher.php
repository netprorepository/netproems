<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Teacher Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $gender
 * @property string $address
 * @property int $country_id
 * @property int $state_id
 * @property string $phone
 * @property string $profile
 * @property string $cv
 * @property string $qualification
 * @property \Cake\I18n\FrozenTime $date_created
 * @property string $passport
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Subject[] $subjects
 */
class Teacher extends Entity
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
        'user_id' => true,
        'gender' => true,
        'address' => true,
        'country_id' => true,
        'state_id' => true,
        'phone' => true,
        'profile' => true,
        'cv' => true,
        'qualification' => true,
        'date_created' => true,
        'passport' => true,
        'user' => true,
        'country' => true,
        'state' => true,
        'subjects' => true
    ];
}
