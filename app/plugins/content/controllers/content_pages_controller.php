<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * ContentPages Controller File
 *
 * PHP version 5
 *
 * @category  Architect
 * @package   AppController
 * @author    Daren Sipes <daren@willetts.com>
 * @author    Jamie Kimmell <jamie@willetts.com>
 * @author    Josh Rhykerd <josh@willetts.com> 
 * @copyright 2010 Willetts Systems, Inc
 * @license   http://www.willetts.com/licenses Architect
 * @version   SVN: $Id$
 * @link      http://willettssystems.beanstalkapp.com
 */
 
 /**
 * ContentPages Controller
 *
 * PHP version 5
 *
 * @category  Architect
 * @package   AppController
 * @author    Daren Sipes <daren@willetts.com>
 * @author    Jamie Kimmell <jamie@willetts.com>
 * @author    Josh Rhykerd <josh@willetts.com> 
 * @copyright 2010 Willetts Systems, Inc
 * @license   http://www.willetts.com/licenses Architect
 * @version   SVN: $Id$
 * @link      http://willettssystems.beanstalkapp.com
 */
class ContentPagesController extends ContentAppController
{
    /**
     * Controller's Name 
     * @var string 
     */
    public $name = 'ContentPages';
    public $components = array('Search.Prg');
    public $paginate = array('limit' => 100, 'order' => 'ContentPage.sort ASC');
	public $helpers = array();

	// This is the max depth of the tree - 0 = root level only, 1 = root + child level, 2 = root + child + grand child, 3 or more infinite levels of great grand children
	public $max_depth 	= 3;
    
    /**
     * Search.Searchable form field parameters
     * @var array
     */
    public $presetVars = array(
		array('field' => 'parent', 'type' => 'value'),
        array('field' => 'active', 'type' => 'value'),
		array('field' => 'search', 'type' => 'value')
    );

    /**
     * AclMenus.Menu controller options
     * @var array
     */
    public $menuOptions = array(
        'weight'      => 10,
        'order'       => array('admin_add', 'admin_index', 'admin_sort'),
        'alias'       => array('admin_index' => 'List Content Pages', 'admin_add' => 'Add Content Page', 'admin_sort' => 'Sort Content Pages'),
        'exclude'     => array('admin_sort_list_process', 'preview')
    );

    /**
     *  View 
     * 
     * @param int $id ID to be Viewed 
     * 
     * @return null 
     */
    function view ($id = null)
    {
        if (!$id) {
            $this->Session->setFlash('Invalid Content Page!', 'flash_it', array('type' => 'error'));
            $this->History->goBack();
        }
        
        $contentPage = $this->ContentPage->read(null, $id);
        $this->set('contentPage', $contentPage);
        $this->set('meta_description', $contentPage['ContentPage']['meta_description']);
		$this->set('meta_keywords', $contentPage['ContentPage']['meta_keywords']);
		$this->set('title_for_layout', $contentPage['ContentPage']['title']);
    }

    /**
     * Admin  Index 
     * 
     * @return null 
     */
    function admin_index()
    {
        // Set the parent_id
        $parent_id = !empty($this->params['named']['parent']) ? $this->params['named']['parent'] : 0;
        
        if(empty($this->passedArgs['parent'])){
            $this->passedArgs['parent'] = $parent_id;
        }
        
        $this->Prg->commonProcess();
        $this->setPaginate(array(
            'conditions' => $this->ContentPage->parseCriteria($this->passedArgs),
        ));
             
        // Get the depth
        $this->ContentPage->recursive = 1;
		$depth = $this->ContentPage->getpath($parent_id, array('ContentPage.id', 'ContentPage.name', 'ContentPage.slug'));
        
        // Let's only let them go so deep!!!
        $depth_reached = false;
		if(count($depth) >= $this->max_depth){
            $depth_reached = true;	
		}
        
        // Set View Variables 
        $this->set('contentPages', $this->paginate('ContentPage'));
        $this->set('parent_id', $parent_id);
        $this->set('depth_reached', $depth_reached);
        $this->set('breadcrumbs', $depth);
    }
    
    function admin_sort_list()
    {
        // Set the parent_id
        $parent_id = !empty($this->params['named']['parent']) ? $this->params['named']['parent'] : 0;

        // Get the depth
        $this->ContentPage->recursive = 1;
		$depth = $this->ContentPage->getpath($parent_id, array('ContentPage.id', 'ContentPage.name', 'ContentPage.slug'));
        
        // Set View Variables 
        $this->set('contentPages', $this->ContentPage->find('all', array('order' => array('ContentPage.sort' => 'ASC'), 'conditions' => array('ContentPage.parent_id' => $parent_id))));
        $this->set('parent_id', $parent_id);
        $this->set('breadcrumbs', $depth);
    }
    
    function admin_sort_list_process()
    {
        debug($this->params);
        exit;
	}

    /**
     * Admin  View 
     * 
     * @param int $id ID to be Viewed 
     * 
     * @return null 
     */
    function admin_view ($id = null)
    {
        if (!$id) {
            $this->Session->setFlash('Invalid Content Page!', 'flash_it', array('type' => 'error'));
            $this->History->goBack();
        }
        $this->set('contentPage', $this->ContentPage->read(null, $id));
    }

    /**
     * Admin  Add 
     * 
     * @return null 
     */
    function admin_add ()
    {
        $parent_id = !empty($this->params['named']['parent']) ? $this->params['named']['parent'] : 0;
        
        if(!empty($this->data)) {    
            if(!empty($this->data['ContentPage']['preview'])){
                $this->ContentPage->set($this->data);
                if($this->ContentPage->validates()){
                    $this->Session->write('contentPage.ContentPage', $this->data['ContentPage']);
                } else {
                    $this->Session->setFlash('The content page could not be previewed. Please, try again.', 'flash_it', array('type' => 'error'));
                    $this->data['ContentPage']['preview'] = 0;
                }
            } else {
                if($this->data['ContentPage']['parent_id'] == 0){
                    unset($this->data['ContentPage']['parent_id']);
                }
                if(empty($this->data['ContentPage']['slug'])){
                    $this->data['ContentPage']['slug'] = strtolower(Inflector::slug($this->data['ContentPage']['name'],'_'));
                } else {
                    $this->data['ContentPage']['slug'] = strtolower(Inflector::slug($this->data['ContentPage']['slug'],'_'));
                }
                if(empty($this->data['ContentPage']['title'])){
                    $this->data['ContentPage']['title'] = $this->data['ContentPage']['name'];
                }
                $this->ContentPage->create();
                if ($this->ContentPage->save($this->data)) {
                    $this->Session->setFlash('The content page has been created.', 'flash_it');
                    $this->History->goBack();
                } else {
                    $this->Session->setFlash('The content page could not be created. Please, try again.', 'flash_it', array('type' => 'error'));
                }
            }
        }
        
        $this->set('parent_id', $parent_id);
    }
        
    function preview($id = null)
    {
        if(!empty($id)){
            return $this->setAction('view', $id);
        } 
            
        $contentPage = $this->Session->read('contentPage');
        $this->Session->delete('contentPage');
        
        if(empty($contentPage)){
            $this->cakeError('error404');
        }
                
        $this->set('contentPage', $contentPage);
        $this->set('meta_description', $contentPage['ContentPage']['meta_description']);
		$this->set('meta_keywords', $contentPage['ContentPage']['meta_keywords']);
		$this->set('title_for_layout', $contentPage['ContentPage']['title']);
            
        $this->theme = WsConfigure::read('Site.Settings.theme');
        $this->render('view');
    }

    /**
     * Admin  Edit 
     * 
     * @param int $id ID to be edited 
     * 
     * @return null 
     */
    function admin_edit ($id = null)
    {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash('Invalid Content Page!', 'flash_it', array('type' => 'error'));
            $this->History->goBack();
        }
        if (!empty($this->data)) {
            if ($this->ContentPage->save($this->data)) {
                $this->Session->setFlash('The content page has been saved.', 'flash_it');
                $this->History->goBack();
            } else {
                $this->Session->setFlash('The content page could not be created. Please, try again.', 'flash_it', array('type' => 'error'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->ContentPage->read(null, $id);
        }
        $parentContentPages = $this->ContentPage->ParentContentPage->find('list');
        $this->set(compact('parentContentPages'));
    }

    /**
     * Admin  Delete 
     * 
     * @param int $id ID to be deleted 
     * 
     * @return null 
     */
    function admin_delete ($id = null)
    {
        if (!$id) {
            $this->Session->setFlash('Invalid Content Page!', 'flash_it', array('type' => 'error'));
            $this->History->goBack();
        }
        if ($this->ContentPage->delete($id)) {
            $this->Session->setFlash('The requested content page has been deleted.', 'flash_it');
            $this->History->goBack();
        }
         $this->Session->setFlash('The requested content page could not be deleted.', 'flash_it', array('type' => 'error'));
        $this->History->goBack();
    }
}