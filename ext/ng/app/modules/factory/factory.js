app.factory("Factory", [
 	'$http', 
 	function ($http) {
        var url = 'api/ModulesInstall';
        var obj = {};
        
        obj.get = function(params) {
            return $http({
        		url: url,
    			method: 'GET',
    			params: params
            });
        };
        
        obj.getModule = function(params) {
            return $http({
        		url: 'api/Modules',
    			method: 'GET',
    			params: params
            });
        };
        
        obj.editModules = function(params) {
            return $http({
        		url: 'api/ModulesEdit',
    			method: 'GET',
    			params: params
            });
        };
        
        obj.remove = function(params) {
        	return $http({
        		method: 'DELETE', 
				url: 'api/Modules',
				data: params
        	});
        };
        
        obj.insert = function(params){
        	return $http({
        		url: url,
    			method: 'POST',
    			data: params
        	});
        };
        
        obj.save = function(params){
        	return $http({
        		url: 'api/Modules',
    			method: 'PUT',
    			data: params
        	});
        };
        
        return obj;
        
 	}
]);
