<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Programes Model
 *
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\BelongsTo $Departments
 *
 * @method \App\Model\Entity\Programe get($primaryKey, $options = [])
 * @method \App\Model\Entity\Programe newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Programe[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Programe|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Programe|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Programe patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Programe[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Programe findOrCreate($search, callable $callback = null, $options = [])
 */
class ProgramesTable extends Table
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

        $this->setTable('programes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER'
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
            ->scalar('programecode')
            ->maxLength('programecode', 10)
            ->requirePresence('programecode', 'create')
            ->notEmpty('programecode');

        $validator
            ->scalar('name')
            ->maxLength('name', 22)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
}
