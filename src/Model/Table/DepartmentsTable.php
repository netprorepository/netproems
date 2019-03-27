<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Departments Model
 *
 * @property \App\Model\Table\FacultiesTable|\Cake\ORM\Association\BelongsTo $Faculties
 * @property \App\Model\Table\ProgramesTable|\Cake\ORM\Association\HasMany $Programes
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Department get($primaryKey, $options = [])
 * @method \App\Model\Entity\Department newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Department[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Department|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Department|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Department patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Department[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Department findOrCreate($search, callable $callback = null, $options = [])
 */
class DepartmentsTable extends Table
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

        $this->setTable('departments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Faculties', [
            'foreignKey' => 'faculty_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Programes', [
            'foreignKey' => 'department_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'department_id'
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
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 250)
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->dateTime('created_date')
            ->requirePresence('created_date', 'create')
            ->notEmpty('created_date');

        $validator
            ->scalar('deptcode')
            ->maxLength('deptcode', 36)
            ->requirePresence('deptcode', 'create')
            ->notEmpty('deptcode');

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
        $rules->add($rules->existsIn(['faculty_id'], 'Faculties'));

        return $rules;
    }
}
