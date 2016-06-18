<?php
use
    OSC\CategoriesDescription\Collection
        as DetailCollection
;
class RestApiCategoriesDetail extends RestApi {

    public function get($params){
        $col = new DetailCollection();
        $col->filterByLanguageId(1);
        $col->sortByOrder('ASC');
        return $this->getReturn($col, $params);
    }

}