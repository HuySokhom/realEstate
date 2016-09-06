<?php
use
    OSC\PartnerBanner\Collection
        as PartnerBannerCollection,
    OSC\PartnerBanner\Object
        as PartnerBannerObject
;
class RestApiPartnerBanner extends RestApi {
    public function get($params){
        $col = new PartnerBannerCollection();
        $col->sortByOrder('ASC');
        return $this->getReturn($col, $params);
    }

    public function post($params){
        $obj = new PartnerBannerObject();
        $obj->setProperties($params['POST']);
        $obj->insert();
        return array(
            'data' => array(
                'id' => $obj->getId()
            )
        );
    }

    public function put($params){
        $obj = new PartnerBannerObject();
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
        $obj = new PartnerBannerObject();
        $obj->setId($this->getId());
        $obj->delete();
    }

}