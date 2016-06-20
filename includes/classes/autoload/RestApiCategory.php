<?php

use
    OSC\CategoriesDescription\Collection
    as CategoryCol
;

class RestApiCategory extends RestApi {

    public function get($params){

        $col = new CategoryCol();
        $col->filterByLanguageId($_SESSION['languages_id']);
        $this->applyFilters($col, $params);
        $this->applySortBy($col, $params);
        return $this->getReturn($col, $params);


//        return array(
//            data => array(
//                html => tep_draw_pull_down_menu('categories_id', tep_get_categories(array(array('id' => '', 'text' =>
//                    '--Select--'))), NULL, 'id="entryCategories" required')
//            )
//        );

    }
}



