<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sparents Model
 *
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsToMany $Students
 *
 * @method \App\Model\Entity\Sparent get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sparent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Sparent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sparent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sparent|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sparent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sparent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sparent findOrCreate($search, callable $callback = null, $options = [])
 */
class SparentsTable extends Table
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

        $this->setTable('sparents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Students', [
            'foreignKey' => 'sparent_id',
            'targetForeignKey' => 'student_id',
            'joinTable' => 'sparents_students'
        ]);
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->maxLength('fatherphone', 18)
            ->requirePresence('fatherphone', 'create')
            ->notEmpty('fatherphone');

        $validator
            ->scalar('motherphone')
            ->maxLength('motherphone', 18)
            ->allowEmpty('motherphone');

        $validator
            ->scalar('fathersjob')
            ->maxLength('fathersjob', 166)
            ->allowEmpty('fathersjob');

        $validator
            ->scalar('mothersjob')
            ->maxLength('mothersjob', 166)
            ->requirePresence('mothersjob', 'create')
            ->notEmpty('mothersjob');

        $validator
            ->integer('pemailaddress')
            ->requirePresence('pemailaddress', 'create')
            ->notEmpty('pemailaddress');

        return $validator;
    }
}
