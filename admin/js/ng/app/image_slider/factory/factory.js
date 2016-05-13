app.factory("Factory", [
 	'$http', 
 	function ($http) {
        
        var obj = {};
        // start get 
        obj.get = function(params) {
            return $http({
        		url: 'api/ImageSlider',
    			method: 'GET',
    			params: params
            });
        };
        
        // end start get 
        
        obj.remove = function(params) {
        	return $http({
        		method: 'DELETE', 
				url: 'api/ImageSlider',
				data: params
        	});
        };
        
        obj.insert = function(params){
        	return $http({
        		url: 'api/ImageSlider',
    			method: 'POST',
    			data: params
        	});
        };
        
        obj.save = function(params, id){
        	return $http({
        		url: 'api/ImageSlider/'+id,
    			method: 'PUT',
    			data: params
        	});
        };
        
        return obj;
        
 	}
]);
