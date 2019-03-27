<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Faculties Model
 *
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\HasMany $Departments
 *
 * @method \App\Model\Entity\Faculty get($primaryKey, $options = [])
 * @method \App\Model\Entity\Faculty newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Faculty[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Faculty|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Faculty|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Faculty patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Faculty[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Faculty findOrCreate($search, callable $callback = null, $options = [])
 */
class FacultiesTable extends Table
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

        $this->setTable('faculties');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Departments', [
            'foreignKey' => 'faculty_id'
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
            ->maxLength('name', 156)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
