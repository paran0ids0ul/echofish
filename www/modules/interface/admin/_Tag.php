<?php

/*
 * $Header: /cvs/echolib/echolib/www/modules/interface/admin/_Tag.php,v 1.1 2011/09/02 10:17:14 proditis Exp $ 
 */
class TagGUI
{
    var $def= 'admin';
    var $mod= 'tag';
    var $tpl= NULL;
    var $SEARCH= array (
        'name'
    );
    var $category= 'USER';
    var $description= 'A simple Tag container module. Other modules attach to it for their purposes.';
    var $fallbackurl= array (
        'container' => '',
        'module' => '',
        'action' => ''
    );
    var $_SEARCH= array ();
    var $actionmenu= array (
        'list' => array (
            'name' => 'List Tags',
            'title' => 'List Tags',
            'description' => 'List Tags',
            'weight' => 100,
            'container' => 'admin',
            'module' => '%',
            'action' => '%',
            'tcontainer' => 'admin',
            'tmodule' => 'tag',
            'taction' => 'index',
            'perm' => 'admin'
        )
    );

    function __construct($smarty= NULL)
    {
        $this->tpl= $smarty;
        foreach ($this->SEARCH as $val)
            $this->_SEARCH[$val]= "";
        $OURDIR= dirname(__FILE__);
        $CONTAINER= basename($OURDIR);
        $MODULE= strtolower(substr(substr(basename(__FILE__), 1), 0, -4));
        $this->def= $CONTAINER;
        $this->mod= $MODULE;
        $this->fallbackurl['container']= $this->def;
        $this->fallbackurl['module']= $this->mod;
        $this->fallbackurl['action']= 'index';

    }
    function getSite()
    {
        if (has_perms('admin'))
            return array ('title' => 'Tag Administration');
    }

    function getActionMenu()
    {
    }

    function index()
    {
        if (!has_perms('admin'))
            gen_uri('home', 'home', 'index', true);
        $page= isset ($_GET['page']) ? intval($_GET['page']) : 0;
        $pager= new Doctrine_Pager(Doctrine_Query :: create()->from(ucfirst($this->mod)), $page);
        $content= $pager->execute();
        $this->tpl->assign('PAGER', $pager);
        $this->tpl->assign('CONTENTLIST', $content);
        $this->tpl->assign('INLINE_BUTTON', 'Add new Tag');
        $this->tpl->assign('INLINE_ACTION', 'add');
        $this->tpl->assign('FORM', $this->_SEARCH);
    }

    function install()
    {
        Doctrine :: createTablesFromArray(array ('Tag'));
        foreach ($this->actionmenu as $key => $menuarr)
        {

            $menu= new Actionmenu();
            $menu->fromArray($menuarr);
            $menu->save();
        }

        $menus= array (
            'delete' => 'list',
            'edit' => 'list',
            'import' => 'thead',
            'export' => 'thead',
            'search' => 'thead',
        );
        $i=0;
        foreach ($menus as $action => $category)
        {
            $module= new Pageaction();
            $module->name= ucfirst($action) . ' ' . $this->mod;
            $module->description= ucfirst($action) . ' ' . $this->mod;
            $module->title= ucfirst($action) . ' ' . $this->mod;
            $module->tcontainer= $this->def;
            $module->tmodule= $this->mod;
            $module->weight=$i++;
            $module->taction= $action;
            $module->category= $category;
            $module->container= $this->def;
            $module->module= $this->mod;
            $module->action= '%';
            $module->save();
            unset ($module);
        }

        $module= new Module();
        $module->name= $this->mod;
        $module->container= $this->def;
        $module->category= $this->category;
        $module->save();
    }

    function uninstall()
    {
        if (!has_perms('admin'))
            gen_uri('home', 'home', 'index', true);
        $conn= Doctrine_Manager :: connection();
        $q= Doctrine_Query :: create()->delete('Module')->where('name = ?', array (
            'tag'
        ))->execute();
        $conn->execute('DROP TABLE IF EXISTS tag');
        $conn->execute('DELETE FROM pageaction where module=? or tmodule=?', array (
            $this->mod,
            $this->mod
        ));
        $conn->execute('DELETE FROM actionmenu where module=? or tmodule=?', array (
            $this->mod,
            $this->mod
        ));
        $conn->execute('DELETE FROM menu where module=?', array (
            $this->mod
        ));
    }

    function export()
    {
        if (!has_perms('admin'))
            gen_uri('home', 'home', 'index', true);
        $pager= Doctrine_Query :: create()->from(ucfirst($this->mod));
        $object= $pager->execute();
        $this->tpl->assign_by_ref('CONTENTLIST', $object);
    }

    function search()
    {
        if (!has_perms('admin'))
            gen_uri('home', 'home', 'index', true);
        $page= isset ($_GET['page']) ? intval($_GET['page']) : 0;
        if (!empty ($_POST))
            $_SESSION['SEARCH']= $_p= _g($_POST, $this->SEARCH);
        else
            if (!empty ($_SESSION['SEARCH']))
                $_p= $_SESSION['SEARCH'];

        $q= Doctrine_Query :: create()->from(ucfirst($this->mod));
        foreach ($_p as $key => $val)
            $q->andWhere("$key LIKE ?");
        $pager= new Doctrine_Pager($q, $page);
        $results= $pager->execute(array_values($_p));
        $this->tpl->assign('PAGER', $pager);
        $this->tpl->assign('CONTENTLIST', $results);
        $this->tpl->assign('INLINE_BUTTON', 'Add new Tag');
        $this->tpl->assign('INLINE_ACTION', 'add');
        $this->tpl->assign('FORM', $_p);
    }

    function add()
    {
        if (!has_perms('admin'))
            gen_uri('home', 'home', 'index', true);
        $RT= Doctrine_Core :: getTable(ucfirst($this->mod));
        if (!empty ($_POST))
        {
            if (isset ($_POST['name']) && !empty ($_POST['name']))
            {
                $tags= $RT->findbyName($_POST['name']);
                if ($tags->toArray() == NULL)
                {
                    unset ($tags);
                    $tags= new tag();
                    $tags->name= $_POST['name'];
                    $tags->save();
                    gen_uri($this->def, $this->mod, 'index', true);
                }
            }
            $this->tpl->assign('FORM', $_POST);
        } else
        {
            $g= new Tag();
            $g= $g->toArray();
            $this->tpl->assign('FORM', $g);
        }

    }

    function delete()
    {
        if (!has_perms('admin'))
            gen_uri('home', 'home', 'index', true);
        $ID= isset ($_GET['ID']) ? intval($_GET['ID']) : 0;
        $tagTable= Doctrine_Core :: getTable(ucfirst($this->mod));
        $tags= $tagTable->find(intval($_GET['ID']));
        if ($tags !== false)
            $tags->delete();
        goback($this->fallbackurl);
    }

    function edit()
    {
        if (!has_perms('admin'))
            gen_uri('home', 'home', 'index', true);
        $RT= Doctrine_Core :: getTable(ucfirst($this->mod));
        if (empty ($_POST))
        {
            $tag= $RT->find(intval($_GET['ID']));
            if ($tag->toArray() !== NULL)
            {
                $_POST['id']= $tag->id;
                $_POST['name']= $tag->name;
                $this->tpl->assign('FORM', $_POST);
            }
        } else
        {
            if (@ $_POST['name'] != '')
            {
                $tag= $RT->find(intval($_POST['id']));
                $tag->name= $_POST['name'];
                $tag->save();
                gen_uri($this->def, $this->mod, 'index', true);
            } else
                $this->tpl->assign('FORM', $_POST);
        }

    }

    function import()
    {
        if (!has_perms('admin'))
            goback($this->fallback);
        if (!empty ($_FILES) && !empty ($_POST))
        {
            if ($_FILES["xml_file"]["error"] <= 0)
                $str_xml= file_get_contents($_FILES['xml_file']['tmp_name']);
            else
                $str_xml= null;
            if ($str_xml != null)
            {
                $xml= simplexml_load_string($str_xml);
                foreach($xml as $xml_item)
                {
                  $user=new Tag();
                  $user->id=$xml_item->id;
                  $user->name=$xml_item->name;
                  $user->replace();
                }
            }
        }
    }

}