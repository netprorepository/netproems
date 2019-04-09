<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FeesTable|\Cake\ORM\Association\BelongsToMany $Fees
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsToMany $Subjects
 *
 * @method \App\Model\Entity\Student get($primaryKey, $options = [])
 * @method \App\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentsTable extends Table
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

        $this->setTable('students');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Fees', [
            'foreignKey' => 'student_id',
            'targetForeignKey' => 'fee_id',
            'joinTable' => 'fees_students'
        ]);
        $this->belongsToMany('Subjects', [
            'foreignKey' => 'student_id',
            'targetForeignKey' => 'subject_id',
            'joinTable' => 'subjects_students'
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
            ->scalar('fname')
            ->maxLength('fname', 188)
            ->requirePresence('fname', 'create')
            ->notEmpty('fname');

        $validator
            ->scalar('lname')
            ->maxLength('lname', 188)
            ->requirePresence('lname', 'create')
            ->notEmpty('lname');

        $validator
            ->scalar('mname')
            ->maxLength('mname', 188)
            ->allowEmpty('mname');

        $validator
            ->scalar('dob')
            ->maxLength('dob', 44)
            ->requirePresence('dob', 'create')
            ->notEmpty('dob');

//        $validator
//            ->dateTime('joindate')
//            ->requirePresence('joindate', 'create')
//            ->notEmpty('joindate');

        $validator
            ->scalar('olevelresulturl')
            ->maxLength('olevelresulturl', 188)
            ->requirePresence('olevelresulturl', 'create')
            ->notEmpty('olevelresulturl');

        $validator
            ->integer('jamb')
            ->requirePresence('jamb', 'create')
            ->notEmpty('jamb');

        $validator
            ->scalar('birthcerturl')
            ->maxLength('birthcerturl', 188)
            ->requirePresence('birthcerturl', 'create')
            ->notEmpty('birthcerturl');

        $validator
            ->scalar('othercerts')
            ->maxLength('othercerts', 188)
            ->allowEmpty('othercerts');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('address')
            ->maxLength('address', 200)
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 16)
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->scalar('fathersname')
            ->maxLength('fathersname', 188)
            ->requirePresence('fathersname', 'create')
            ->notEmpty('fathersname');

        $validator
            ->scalar('mothersname')
            ->maxLength('mothersname', 188)
            ->requirePresence('mothersname', 'create')
            ->notEmpty('mothersname');

        $validator
            ->scalar('fatherphone')
            ->maxLength('fatherphone', 16)
            ->requirePresence('fatherphone', 'create')
            ->notEmpty('fatherphone');

        $validator
            ->scalar('motherphone')
            ->maxLength('motherphone', 16)
            ->requirePresence('motherphone', 'create')
            ->notEmpty('motherphone');

        $validator
            ->scalar('fathersjob')
            ->maxLength('fathersjob', 199)
            ->allowEmpty('fathersjob');

        $validator
            ->scalar('mothersjob')
            ->maxLength('mothersjob', 188)
            ->allowEmpty('mothersjob');

        $validator
            ->scalar('passporturl')
            ->maxLength('passporturl', 199)
            ->allowEmpty('passporturl');

        $validator
            ->scalar('regno')
            ->maxLength('regno', 50)
            ->allowEmpty('regno');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['department_id'], 'Departments'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
