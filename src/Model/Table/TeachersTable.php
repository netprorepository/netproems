<<<<<<< HEAD
<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Teachers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsToMany $Subjects
 * @property \App\Model\Table\SubjectTeachersTable|\Cake\ORM\Association\HasMany $SubjectTeachers
 *
 * @method \App\Model\Entity\Teacher get($primaryKey, $options = [])
 * @method \App\Model\Entity\Teacher newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Teacher[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Teacher|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Teacher|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Teacher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Teacher[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Teacher findOrCreate($search, callable $callback = null, $options = [])
 */
class TeachersTable extends Table
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

        $this->setTable('teachers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Subjects', [
            'foreignKey' => 'teacher_id',
            'targetForeignKey' => 'subject_id',
            'joinTable' => 'subjects_teachers'
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
            ->scalar('gender')
            ->maxLength('gender', 8)
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 16)
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->scalar('profile')
            ->maxLength('profile', 255)
            ->requirePresence('profile', 'create')
            ->notEmpty('profile');

        $validator
            ->scalar('cv')
            ->maxLength('cv', 128)
            ->allowEmpty('cv');

        $validator
            ->scalar('qualification')
            ->maxLength('qualification', 16)
            ->requirePresence('qualification', 'create')
            ->notEmpty('qualification');

//        $validator
//            ->dateTime('date_created')
//            ->requirePresence('date_created', 'create')
//            ->notEmpty('date_created');

        $validator
            ->scalar('passport')
            ->maxLength('passport', 156)
            ->allowEmpty('passport');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
=======
<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Teachers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsToMany $Subjects
 * @property \App\Model\Table\SubjectTeachersTable|\Cake\ORM\Association\HasMany $SubjectTeachers
 *
 * @method \App\Model\Entity\Teacher get($primaryKey, $options = [])
 * @method \App\Model\Entity\Teacher newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Teacher[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Teacher|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Teacher|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Teacher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Teacher[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Teacher findOrCreate($search, callable $callback = null, $options = [])
 */
class TeachersTable extends Table
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

        $this->setTable('teachers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Subjects', [
            'foreignKey' => 'teacher_id',
            'targetForeignKey' => 'subject_id',
            'joinTable' => 'subjects_teachers'
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
            ->scalar('gender')
            ->maxLength('gender', 8)
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 16)
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->scalar('profile')
            ->maxLength('profile', 255)
            ->requirePresence('profile', 'create')
            ->notEmpty('profile');

        $validator
            ->scalar('cv')
            ->maxLength('cv', 128)
            ->allowEmpty('cv');

        $validator
            ->scalar('qualification')
            ->maxLength('qualification', 16)
            ->requirePresence('qualification', 'create')
            ->notEmpty('qualification');

//        $validator
//            ->dateTime('date_created')
//            ->requirePresence('date_created', 'create')
//            ->notEmpty('date_created');

        $validator
            ->scalar('passport')
            ->maxLength('passport', 156)
            ->allowEmpty('passport');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
>>>>>>> origin/dev1
