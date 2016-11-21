<?php

namespace AppBundle\Twig;

class ViewHelper extends \Twig_Extension
{

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('editLink',  array($this, 'editLink'), ['is_safe' => array('html')]),
            new \Twig_SimpleFunction('backToList',  array($this, 'backToList'), ['is_safe' => array('html')]),
        ];
    }


    public function editLink($link)
    {
        return '<a href="' . $link . '" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>';
    }
    
    public function backToList($link) {
        return '<a href="'.$link.'" class="btn btn-success" style="float:right">Revenir à la liste</a>';
    }

    public function getName()
    {
        return 'view_helper';
    }
}