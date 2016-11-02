app.controller(
	'customer_plan_upgrade_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, 'Services'
	, 'alertify'
	, function ($scope, Restful, $location, Services, $alertify){
		var vm = this;
		vm.service = new Services();
		vm.from_date = moment().format('YYYY-MM-DD');
		vm.to_date = moment().format('YYYY-MM-DD');
		var params = {};
		var url = 'api/CustomerPlanUpgrade/';
		vm.init = function(params){
			params.pagination = 'yes';
			params.from_date = vm.from_date;
			params.to_date = vm.to_date;
			console.log(params);
			Restful.get(url, params).success(function(data){
				vm.plans = data;console.log(data);
				vm.totalItems = data.count;
			});
		};
		vm.init(params);

		vm.updateStatus = function(params){
			params.status == 1 ? params.status = 0 : params.status = 1;console.log(params);
			var data = { status: params.status, customers_id: params.detail[0].id, plan: params.plan};
			Restful.put(url + params.id, data).success(function(data){
				console.log(data);
				vm.service.alertMessage('<strong>Complete: </strong> Update Status Success.');
			});
		};

		// remove functionality
		vm.remove = function(id, $index){
			vm.id = id;
			vm.index = $index;

			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("Are you sure want to delete this record?", function (ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
					Restful.delete( url + vm.id ).success(function(data){
						vm.disabled = true;
						vm.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						vm.init(params);
						//vm.news.elements.splice(vm.index, 1);
						//$('#message').modal('hide');
					});
				}, function(ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
				});

		};
		// search functionality
		vm.search = function(){
			params.id = vm.customer_id;
			params.status = vm.status;
			vm.init(params);
		};
		/**
		 * start functionality pagination
		 */
		vm.currentPage = 1;
		//get another portions of data on page changed
		vm.pageChanged = function() {
			vm.pageSize = 10 * ( vm.currentPage - 1 );
			params.start = vm.pageSize;
			vm.init(params);
		};
	}
]);
