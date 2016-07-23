app.service("Services",[
    'alertify',
	function($alertify) {
        var services = function(){
            var self = this;
        };
        services.prototype.getUser = function(){
            //@todo
        };

        services.prototype.alertMessage = function(text){
            $alertify.logPosition("top right");
            $alertify.success(text);
        };


        // functionality format datetime
        services.prototype.formatDate = function(date){
            var dateOut = new Date(date);
            return dateOut;
        };

        return services;
        
 	}
]);