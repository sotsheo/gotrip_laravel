<?php  
namespace App\Cl;


class ClCategory{
	const ACTIVE=1;
	const NOT_ACTIVE=0;
	const LIMIT_DEFAULT=20;
	function createCategory($elements, $parentId = 0) {

	    $branch = array();
	   	
	    foreach ($elements as $key =>$element) {
				
	        if ($element['id_parent'] == $parentId) {
	            $children = $this->createCategory($elements, $element['id']);
	            if ($children) {
	                $element['children'] = $children;
	            }
	            $branch[] = $element;
	        }
	    }

    	return $branch;
	}

	function showCategories($categories, $parent_id = 0, $char = '') {
        foreach ($categories as $key => $item) {
             // Nếu là chuyên mục con thì hiển thị
             if ($item['id_parent'] == $parent_id) {
                 $item['name'] = $char . $item['name'];
                 
                 $this->categorys[] = $item;
                 // Xóa chuyên mục đã lặp
                 unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                 $this->showCategories($categories, $item['id'], $char . '|---');
                
             }
         }
    }

    
	
}