<?php

/**
 * Searchbookmark
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Searchbookmark.php,v 1.1 2011/09/02 10:17:12 proditis Exp $
 */
class Searchbookmark extends BaseSearchbookmark
{
    public function setQuery($query)
    {
        return $this->_set('query', serialize($query));
    }

    public function getQuery()
    {
        return unserialize($this->_get('query'));
    }

    public function getmylink()
    {
        $id=$this->_get('id');
        return gen_uri('admin','searchbookmark','follow')."&ID=$id";
    }
    public function getQuerystring()
    {
        $q=$this->getQuery();
        $str=null;
        foreach($q as $key => $val)
            $str[]="$key => $val";
        return implode(', ',$str);
    }
    
    public function save()
    {
        try
        {
            parent::save();
        } catch (Exception $e)
        {
            switch ($e->getCode())
            {
                case 23000 :
                case 1062 :
                    parent::replace();
                    break;
                default :
                    throw $e;
            }
        }
    }
}