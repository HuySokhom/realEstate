app.factory("Factory", [
 	'$http', 
 	function ($http) {
        
        var obj = {};
        // start get 
        obj.getVehicles = function(params) {
            return $http({
        		url: 'api/Vehicles',
    			method: 'GET',
    			params: params
            });
        };
        
        // end start get 
        
        obj.remove = function(params) {
        	return $http({
        		method: 'DELETE', 
				url: 'api/Vehicles',
				data: params
        	});
        };
        
        obj.insert = function(params){
        	return $http({
        		url: 'api/Vehicles',
    			method: 'POST',
    			data: params
        	});
        };
        
        obj.save = function(params){
        	return $http({
        		url: 'api/Vehicles',
    			method: 'PUT',
    			data: params
        	});
        };
        
        return obj;
        
 	}
]);
