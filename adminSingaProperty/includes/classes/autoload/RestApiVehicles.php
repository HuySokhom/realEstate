<?php

use
	OSC\Vehicles\Type\Collection
		as VehiclesTypeCollection,
	OSC\Vehicles\Brand\Collection
		as VehiclesBrandCollection,
	OSC\Vehicles\Model\Collection
		as VehiclesModelCollection,
	OSC\Vehicles\Seat\Collection
		as VehiclesSeatCollection,
	// include object
	OSC\Vehicles\Type\Object
		as VehiclesTypeObject,
	OSC\Vehicles\Brand\Object
		as VehiclesBrandObject,
	OSC\Vehicles\Model\Object
		as VehiclesModelObject,
	OSC\Vehicles\Seat\Object
		as VehiclesSeatObject
;

class RestApiVehicles extends RestApi {

	public function get($params){
		
		if( $params['GET']['Type'] == 'model'){
			$col = new VehiclesModelCollection();
		}
		elseif ($params['GET']['Type'] == 'brand'){
			$col = new VehiclesBrandCollection();
		}elseif ($params['GET']['Type'] == 'seat'){
			$col = new VehiclesSeatCollection();
		}else{
			$col = new VehiclesTypeCollection();
		}
		$this->applyFilters($col, $params);
		$this->applyLimit($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
		
	}
	
	public function post($params){
		$obj = $this->getModuleName($params['POST']['type']);
		// unset object type no need to set properties
		unset($params['POST']['type']);
		
		$obj->setProperties($params['POST']);
		
		$obj->insert();
		return array(
			'data' => array(
				'id' => $obj->getId()
			)
		);
	}
	
	public function put($params){
		$obj = $this->getModuleName($params['PUT']['type']);	
		// unset object type no need to set properties
		unset($params['PUT']['type']);
		$obj->setProperties($params['PUT']);
		$obj->update();
		return array(
			'data' => array(
				'id' => $obj->getId()
			)
		);
	}
	
	public function getModuleName($type){
		if( $type == 'model'){
			$obj = new VehiclesModelObject();
		}
		elseif ($type == 'brand'){
			$obj = new VehiclesBrandObject();
		}elseif ($type == 'seat'){
			$obj = new VehiclesSeatObject();
		}else{
			$obj = new VehiclesTypeObject();
		}
		return $obj;
	}
	
	public function delete($params){
		// loop to get key from delete parse data in string
		foreach ($params['DELETE'] as $key => $value) {
			$name = $key;
		}
		// decode string to object
		$type = json_decode($name);
		$obj = $this->getModuleName($type->type);
		
		$obj->setId($type->id);
		$obj->delete();
		
	}
	
}
