var app = angular.module(
	'main',
	[
	 	'ui.router'
		, 'ui.bootstrap'
		, 'ngSanitize'
		, 'ui.tinymce'
		, 'ngFileUpload'
		, 'ngCookies'
		, 'ngAlertify'
	]
);
// range with number
app.filter('rangeNumber', function () {
	return function (input, total) {
		total = parseInt(total);
		for (var i = 1; i <= total; i++) {
			//if(i <= 9 ){

			//}
			input.push(i);
		}
		return input;
	};
});


app.directive('dropZone', function() {
	return {
		scope: {
			action: "@",
			autoProcess: "=?",
			callBack: "&?",
			dataMax: "=?",
			mimetypes: "=?",
			message: "@?",
		},
		link: function (scope, element, attrs) {
			console.log("Creating dropzone");

			// Autoprocess the form
			if (scope.autoProcess != null && scope.autoProcess == "false") {
				scope.autoProcess = false;
			} else {
				scope.autoProcess = true;
			}

			// Max file size
			if (scope.dataMax == null) {
				scope.dataMax = Dropzone.prototype.defaultOptions.maxFilesize;
			} else {
				scope.dataMax = parseInt(scope.dataMax);
			}

			// Message for the uploading
			if (scope.message == null) {
				scope.message = Dropzone.prototype.defaultOptions.dictDefaultMessage;
			}

			element.dropzone({
				url: scope.action,
				maxFilesize: scope.dataMax,
				paramName: "file",
				acceptedFiles: scope.mimetypes,
				maxThumbnailFilesize: scope.dataMax,
				dictDefaultMessage: scope.message,
				autoProcessQueue: scope.autoProcess,
				success: function (file, response) {
					if (scope.callBack != null) {
						scope.callBack({response: response});
					}
				}
			});
		}
	}
});