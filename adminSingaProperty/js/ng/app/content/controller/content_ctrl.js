app.controller(
	'content_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, 'Services'
	, function ($scope, Restful, $location, Services){
		$scope.service = new Services();

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
			var data = {
				title: $scope.title,
				content: $scope.content,
				language_id: $scope.language_id,
			};
			$scope.isDisabled = true;
			if( $scope.id ){
				console.log(data);
				Restful.put(url + $scope.id, data).success(function(data){
					console.log(data);
					$scope.init();
					$('#contentPopup').modal('hide');
					$scope.isDisabled = false;
					$scope.service.alertMessage('<strong>Complete: </strong>Update Success.');
				});
			}
		};

		// edit functionality
		$scope.edit = function(params){console.log(params);
			$scope.content = params.content;
			$scope.id = params.id;
			$scope.title = params.title;
			$scope.language_id = params.language_id;
			$('#contentPopup').modal('show');
		};

	}
]);
