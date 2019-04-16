<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\LogsTable|\Cake\ORM\Association\HasMany $Logs
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
           // 'joinType' => 'INNER'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Logs', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username','Please provide a valid email address as your user name')
             ->add('username', ['unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'username already exists']])   
	             ->add('username', 'valid-email', ['rule' => 'email'])
            ->requirePresence('password', 'create')
            ->add('password', [ 'length' => [ 'rule' => ['minLength', 6],
            'message' => 'Invalid password. password must not be less than six characters', ]])
           ->notEmpty('password')
           ->notEmpty('cpassword')
           ->add('cpassword', 'custom', [
                    'rule' => function($value, $context) {
                        if ($value !== $context['data']['password']) {
                            return false;
                        }
                        return true;
                   },
                  'message' => 'Password mismatch. Please verify your password and try again',
        ]); 

        $validator
            ->scalar('username')
            ->maxLength('username', 250)
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 250)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('fname')
            ->maxLength('fname', 64)
            ->requirePresence('fname', 'create')
            ->notEmpty('fname');

        $validator
            ->scalar('lname')
            ->maxLength('lname', 64)
            ->requirePresence('lname', 'create')
            ->notEmpty('lname');

        $validator
            ->scalar('mname')
            ->maxLength('mname', 64)
            ->allowEmpty('mname');

      /*  $validator
            ->scalar('gender')
            ->maxLength('gender', 15)
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->scalar('address')
            ->maxLength('address', 250)
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 32)
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->scalar('profile')
            ->allowEmpty('profile');

        $validator
            ->scalar('dob')
            ->maxLength('dob', 64)
            ->allowEmpty('dob');*/

//        $validator
//            ->dateTime('created_date')
//            ->requirePresence('created_date', 'create')
//            ->notEmpty('created_date');

//        $validator
//            ->integer('created_by')
//            ->requirePresence('created_by', 'create')
//            ->notEmpty('created_by');

       /* $validator
            ->scalar('passport')
            ->maxLength('passport', 128)
            ->allowEmpty('passport');*/

//        $validator
//            ->scalar('useruniquid')
//            ->maxLength('useruniquid', 28)
//            ->requirePresence('useruniquid', 'create')
//            ->notEmpty('useruniquid');

//        $validator
//            ->scalar('userstatus')
//            ->maxLength('userstatus', 30)
//            ->requirePresence('userstatus', 'create')
//            ->notEmpty('userstatus');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        /*$rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['state_id'], 'States'));*/
        $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
}
