<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 12/30/15
 * Time: 2:55 PM
 */
use
    OSC\ImageSlider\Collection
        as ImageSliderCollection,
    OSC\ImageSlider\Object
        as ImageSliderObject
;
class RestApiCategoriesBrand extends RestApi {
    public function get($params){
        $col = new ImageSliderCollection();
        // start limit page
        $showDataPerPage = 10;
        $start = $params['GET']['start'];
        $this->applyLimit($col,
            array(
                'limit' => array( $start, $showDataPerPage )
            )
        );
//        $this->applyFilters($col, $params);
        $col->sortByOrder('ASC');
        return $this->getReturn($col, $params);
    }

    public function post($params){
        $obj = new ImageSliderObject();
        $obj->setProperties($params['POST']);
        $obj->insert();
        return array(
            'data' => array(
                'id' => $obj->getId()
            )
        );
    }

    public function put($params){
        $obj = new ImageSliderObject();
        $obj->setId($this->getId());
        $obj->setProperties($params['PUT']);
        $obj->update();
        return array(
            'data' => array(
                'id' => $obj->getId()
            )
        );
    }

    public function delete($params){
        // loop to get key from delete parse data in string
        foreach ($params['DELETE'] as $key => $value) {
            $name = $key;
        }
        // decode string to object
        $type = json_decode($name);
        $obj = new ImageSliderObject();

        $obj->setId($type->id);
        $obj->delete();

    }

}