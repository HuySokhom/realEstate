app.controller(
	'content_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, 'Services'
	, function ($scope, Restful, $location, Services){
		$scope.service = new Services();
		$scope.editChange = true;
		// init tiny option
		$scope.tinymceOptions = {
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars fullscreen",
				"insertdatetime media nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor colorpicker textpattern media"
			],
			fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
			toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			image_advtab: true,
			paste_data_images: true
		};


		var url = 'api/Content/';
		$scope.init = function(params){
			Restful.get(url).success(function(data){
				$scope.contents = data;
			});
		};
		$scope.init();

		// save functionality
		$scope.save = function(){
			$scope.isDisabled = true;
			Restful.put(url, $scope.page_detail).success(function(data){
				$scope.init();
				$scope.isDisabled = false;
				$scope.editChange = true;
				$scope.service.alertMessage('<strong>Complete: </strong>Update Success.');
			});
		};

		// edit functionality
		$scope.edit = function(params){
			$scope.editChange = false;
			$scope.page_detail = angular.copy(params.detail);
		};

	}
]);
