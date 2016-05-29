app.service("Services",
	function() {
        var services = function(){
            var self = this;
        };
        services.prototype.getUser = function(){
            //@todo
        };

        services.prototype.alertMessage = function(title, message, type){
            $.notify({
                title: '<b>' + title + '</b>',
                message: message
            },{
                type: type
            });
        };

        return services;
        
 	}
);