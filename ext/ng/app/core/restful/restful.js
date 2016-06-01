app.factory("Restful", [
 	'$http', 
 	function ($http) {
        
        var obj = {};
        // start get 
        obj.get = function(url, params) {
            return $http({
        		url: url,
    			method: 'GET',
    			params: params
            });
        };

		obj.post = function(url, params) {
			return $http({
				url: url,
				method: 'POST',
				data: params
			});
		};

        obj.put = function(url, params){
        	return $http({
        		url: url,
    			method: 'PUT',
    			data: params
        	});
        };
        
        obj.patch = function(url, params){
        	return $http({
        		url: url,
    			method: 'PATCH',
    			data: params
        	});
        };
        
        obj.delete = function(url, params){
        	return $http({
        		url: url,
    			method: 'DELETE',
    			data: params
        	});
        };
        
        return obj;
        
 	}
]);

app.directive('tooltip', function(){
	return {
		restrict: 'A',
		link: function(scope, element, attrs){
			$(element).hover(function(){
				// on mouseenter
				$(element).tooltip('show');
			}, function(){
				// on mouseleave
				$(element).tooltip('hide');
			});
		}
	};
});