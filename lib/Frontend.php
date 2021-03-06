<?php

/**
 * Consult documentation on http://agiletoolkit.org/learn 
 */
class Frontend extends ApiFrontend {

    function init() {
        parent::init();
        // Keep this if you are going to use database on all pages
        $this->dbConnect();
        $this->requires('atk', '4.2.5');
        $auth = $this->add('ApplicationAuth');
        //$auth->allowPage(array('index'));
        // This will add some resources from atk4-addons, which would be located
        // in atk4-addons subdirectory.
        $this->addLocation('atk4-addons', array(
                    'php' => array(
                        'mvc',
                        'misc/lib',
                        'filestore',
                    )
                ))
                ->setParent($this->pathfinder->base_location);
        $this->pathfinder->addLocation('.', array('addons' => array('ds-addons', 'wr-addons')));
        // A lot of the functionality in Agile Toolkit requires jUI
        $this->add('jUI');
        $this->js()
                ->_load('atk4_univ')
                ->_load('ui.atk4_notify')
        ;
        $layout=$this->add('Layout/Layout');
        $l = $this->add('menu/Menu_Dropdown', null, 'Menu'); // DON'T USE FIELD NAMED "ID", because it's already built-in Model class as auto-incremental
        
        if ($auth->isLoggedIn()){
            
            $l->setSource(array(
                array('ids' => 0, 'page' => 'index', 'name' => 'Home', 'parent_id' => null),
                array('ids' => 1, 'page' => 'snapshot', 'name' => 'Snapshots', 'parent_id' => null),
                array('ids' => 2, 'page' => 'logout', 'name' => 'Logout', 'parent_id' => null)                
            ));
    }
    }

    function initLayout() {
        $this->auth->check();
        parent::initLayout();
    }

}