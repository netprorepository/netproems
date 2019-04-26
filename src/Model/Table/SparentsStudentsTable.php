<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SparentsStudents Model
 *
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\SparentsStudentsTable|\Cake\ORM\Association\BelongsTo $ParentSparentsStudents
 * @property \App\Model\Table\SparentsStudentsTable|\Cake\ORM\Association\HasMany $ChildSparentsStudents
 *
 * @method \App\Model\Entity\SparentsStudent get($primaryKey, $options = [])
 * @method \App\Model\Entity\SparentsStudent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SparentsStudent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SparentsStudent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SparentsStudent|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SparentsStudent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SparentsStudent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SparentsStudent findOrCreate($search, callable $callback = null, $options = [])
 */
class SparentsStudentsTable extends Table
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

        $this->setTable('sparents_students');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ParentSparentsStudents', [
            'className' => 'SparentsStudents',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildSparentsStudents', [
            'className' => 'SparentsStudents',
            'foreignKey' => 'parent_id'
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
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentSparentsStudents'));

        return $rules;
    }
}
