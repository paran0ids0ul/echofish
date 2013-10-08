<?php

/**
 * User
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: User.php,v 1.3 2011/08/31 17:10:19 proditis Exp $
 */
class User extends BaseUser
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
    
    public function setPassword($password)
    {
        return $this->_set('password', sha1($password));
    }
    public function setRawpassword($password)
    {
        return $this->_set('password', $password);
    }
}