<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Levels Model
 *
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 *
 * @method \App\Model\Entity\Level get($primaryKey, $options = [])
 * @method \App\Model\Entity\Level newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Level[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Level|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Level|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Level patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Level[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Level findOrCreate($search, callable $callback = null, $options = [])
 */
class LevelsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('levels');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Students', [
            'foreignKey' => 'level_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 44)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
