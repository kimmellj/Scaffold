<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * ContentPage Model File
 *
 * PHP version 5
 *
 * @category  Architect
 * @package   AppModel
 * @author    Daren Sipes <daren@willetts.com>
 * @author    Jamie Kimmell <jamie@willetts.com>
 * @author    Josh Rhykerd <josh@willetts.com> 
 * @copyright 2010 Willetts Systems, Inc
 * @license   http://www.willetts.com/licenses Architect
 * @version   SVN: $Id$
 * @link      http://willettssystems.beanstalkapp.com
 */
 
 /**
 * ContentPage Model
 *
 * PHP version 5
 *
 * @category  Architect
 * @package   AppModel
 * @author    Daren Sipes <daren@willetts.com>
 * @author    Jamie Kimmell <jamie@willetts.com>
 * @author    Josh Rhykerd <josh@willetts.com> 
 * @copyright 2010 Willetts Systems, Inc
 * @license   http://www.willetts.com/licenses Architect
 * @version   SVN: $Id$
 * @link      http://willettssystems.beanstalkapp.com
 */

class ContentPage extends ContentAppModel
{
    /**
     * Model's Name 
     * @var string 
     */
    public $name = 'ContentPage';

    /**
     * Display Field 
     * @var string 
     */
    public $displayField = 'name';
    
    public $actsAs = array('Tree', 'Search.Searchable', 'Utils.Toggleable' => array('fields' => array('active' => array(0, 1))));
    
    /**
     * Validation
     * @var string
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Enter name',
            ),
        ),
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Enter title',
            ),
        ),
        'slug' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Enter pretty url',
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'The pretty url must be unique.',
            ),
        ),
    );

    /**
     * belongsTo Association(s)
     * @var array
     */
    public $belongsTo = array(
		'ParentContentPage' => array(
			'className' => 'ContentPage',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    /**
     * Has Many Association(s)
     * @var array
     */ 
    public $hasMany = array(
		'ChildContentPage' => array(
			'className' => 'ContentPage',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
    
    /**
     * Search.Searchable plugin field parameters
     * @var array
     */
    public $filterArgs = array(
		array('name' => 'parent', 'field' => 'ContentPage.parent_id', 'type' => 'value'),
        array('name' => 'active', 'field' => 'ContentPage.active', 'type' => 'value'),
        array('name' => 'search', 'type' => 'query', 'method' => '__orSearchConditionsSearchable')
    );

    /**
     * Create user search conditions for Search.Searchable plugin query
     *
     * @param array $data Search data
     * @return array of query conditions
     */
    public function __orSearchConditionsSearchable($data = array()) {
        $search = $data['search'];
        $conditions = array(
            'OR' => array(
                $this->alias . '.name LIKE' => '%' . $search . '%',
                $this->alias . '.title LIKE' => '%' . $search . '%',
                $this->alias . '.slug LIKE' => '%' . $search . '%',
                $this->alias . '.content LIKE' => '%' . $search . '%',
            )
        );
        return $conditions;
    }
    
    function beforeFind(){
        $this->virtualFields = array(
            'childCount' => '(SELECT COUNT(*) FROM content_pages AS cp WHERE cp.parent_id = ContentPage.id)',                              
        );
        return true;
    }

}
?>