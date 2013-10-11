<?php

/**
 * BasePageaction
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $title
 * @property string $description
 * @property integer $weight
 * @property string $container
 * @property string $module
 * @property string $action
 * @property string $tcontainer
 * @property string $tmodule
 * @property string $taction
 * @property enum $category
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: BasePageaction.php,v 1.4 2011/08/30 16:24:07 proditis Exp $
 */
abstract class BasePageaction extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('pageaction');
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('title', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('description', 'string', 150, array(
             'type' => 'string',
             'length' => '150',
             ));
        $this->hasColumn('weight', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('container', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('module', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('action', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('tcontainer', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('tmodule', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('taction', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('category', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'list',
              1 => 'thead',
             ),
             ));
        $this->hasColumn('perm', 'integer', null, array(
             'type' => 'integer',
             'length' => '1',
             'default' => '4',
             ));


        $this->index('name_index', array(
             'fields' => 
             array(
              'name' => 
              array(
              ),
             ),
             ));
        $this->index('title_index', array(
             'fields' => 
             array(
              'title' => 
              array(
              ),
             ),
             ));
        $this->index('description_index', array(
             'fields' => 
             array(
              'description' => 
              array(
              ),
             ),
             ));
        $this->index('container_index', array(
             'fields' => 
             array(
              'container' => 
              array(
              ),
             ),
             ));
        $this->index('module_index', array(
             'fields' => 
             array(
              'module' => 
              array(
              ),
             ),
             ));
        $this->index('action_index', array(
             'fields' => 
             array(
              'action' => 
              array(
              ),
             ),
             ));
        $this->index('tcontainer_index', array(
             'fields' => 
             array(
              'tcontainer' => 
              array(
              ),
             ),
             ));
        $this->index('tmodule_index', array(
             'fields' => 
             array(
              'tmodule' => 
              array(
              ),
             ),
             ));
        $this->index('taction_index', array(
             'fields' => 
             array(
              'taction' => 
              array(
              ),
             ),
             ));
        $this->option('connection', 'globocam_classic');
        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}