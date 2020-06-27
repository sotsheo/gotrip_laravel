<?php  
namespace App\Cl;


class ClMenu{

	function createMenu($elements, $parentId = 0) {

	    $branch = array();
	   	
	    foreach ($elements as $key =>$element) {
				
	        if ($element['id_parent'] == $parentId) {
	            $children = $this->createMenu($elements, $element['id']);
	            if ($children) {
	                $element['children'] = $children;
	            }
	            $branch[] = $element;
	        }
	    }

    	return $branch;
	}

	
	
}