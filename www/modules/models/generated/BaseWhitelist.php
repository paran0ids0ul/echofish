<?php

/**
 * BaseWhitelist
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property clob $description
 * @property string $program
 * @property string $pattern
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: BaseWhitelist.php,v 1.1.6.1 2011/09/02 12:03:29 proditis Exp $
 */
abstract class BaseWhitelist extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('whitelist');
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('description', 'clob', 256, array(
             'type' => 'clob',
             'length' => '256',
             ));
        $this->hasColumn('host', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'unsigned' => true,
             ));

        $this->hasColumn('facility', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('level', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->hasColumn('program', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('pattern', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));


        $this->index('program_index', array(
             'fields' => 
             array(
              'program' => 
              array(
              ),
             ),
             ));
        $this->index('name_index', array(
             'fields' => 
             array(
              'name' => 
              array(
              ),
             ),
             'type' => 'unique',
             ));
        $this->index('pattern_index', array(
             'fields' => 
             array(
              'pattern' => 
              array(
              ),
             ),
             'type' => 'unique',
             ));
        $this->index('combo_index', array(
             'fields' => 
             array(
              'program' => 
              array(
              ),
              'pattern' => 
              array(
              ),
             ),
             'type' => 'unique',
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