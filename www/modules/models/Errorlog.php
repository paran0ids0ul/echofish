<?php

/**
 * Errorlog
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Errorlog.php,v 1.2 2011/08/27 09:23:59 proditis Exp $
 */
class Errorlog extends BaseErrorlog
{
    public function getRequest()
    {
        return unserialize($this->_get('request'));
    }
}