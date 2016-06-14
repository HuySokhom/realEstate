<?php
class RestApiCategory extends RestApi {
    public function get(){
        return array(
            data => array(
                html => tep_draw_pull_down_menu('categories_id', tep_get_categories(array(array('id' => '', 'text' =>
                    '--Select--'))), NULL, 'id="entryCategories" required')
            )
        );

    }
}



