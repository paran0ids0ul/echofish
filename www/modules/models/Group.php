<?php

/**
 * Group
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Group.php,v 1.2 2011/08/30 15:34:09 proditis Exp $
 */
class Group extends BaseGroup
{
    public function save()
    {
        try
        {
            parent :: save();
        } catch (Exception $e)
        {
            switch ($e->getCode())
            {
                case 23000 :
                case 1062 :
                    parent :: replace();
                    break;
                default :
                    throw $e;
            }
        }
    }
}