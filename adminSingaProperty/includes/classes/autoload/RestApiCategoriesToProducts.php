<?php
use
    OSC\ProductToCategory\Collection
        as DetailCollection
;
class RestApiCategoriesToProducts extends RestApi {

    public function get($params){
        $col = new DetailCollection();

        return $this->getReturn($col, $params);
    }

}