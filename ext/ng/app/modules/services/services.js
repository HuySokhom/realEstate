app.service("Services", 
	function() {
		
        this.alertMessage = function(attr){
        	$(attr).show();
			setTimeout(function(){
				$(attr).hide();
			},1000);
        };
        
        this.getAllElements = function(){
        	var array = [];
			angular.forEach(angular.element.find('input'), function(element){ 
				// replace text name
				var key = $(element).attr('name').replace('configuration', '');
				key = key.substring(1, key.length-1);
				var value = $(element).val();
				var type = $(element).attr('type');
				// check if type radio
				if(type == 'radio'){
					// get value if checked true
					if($(element)[0].checked == true){
						array.push({
							cf_key: key,
							cf_value: value
						});
					}
				}else{
					array.push({
						cf_key: key,
						cf_value: value
					});
				}
			});
			angular.forEach(angular.element.find('select'), function(element){
				var key = $(element).attr('name').replace('configuration', '');
				key = key.substring(1, key.length-1);
				var value = $(element).val();
				array.push({
					cf_key: key,
					cf_value: value
				});
			});
			
			return array;
        };
        
 	}
);
