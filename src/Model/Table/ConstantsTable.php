<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Constants Model
 *
 * @method \App\Model\Entity\Constant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Constant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Constant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Constant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Constant|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Constant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Constant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Constant findOrCreate($search, callable $callback = null, $options = [])
 */
class ConstantsTable extends Table
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

        $this->setTable('constants');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->maxLength('name', 16)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('value')
            ->maxLength('value', 16)
            ->requirePresence('value', 'create')
            ->notEmpty('value');

        return $validator;
    }
}
