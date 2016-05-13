<?php
/**
 * Created by PhpStorm.
 * User: dvp-evisa
 * Date: 4/27/2016
 * Time: 4:26 PM
 */



require('includes/application_top.php');
//require(DIR_WS_INCLUDES . 'template_top.php');
?>
<link href="ext/dropzone/dropzone.min.css" rel="stylesheet">

<form action="upload.php" class="dropzone" drop-zone="" id="file-dropzone"></form>
<script src="ext/jquery/jquery-1.11.1.min.js"></script>
<script src="ext/dropzone/dropzone.min.js"></script>
<?php
  //require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>

<script type="text/javascript">
    Dropzone.autoDiscover = false;
        // instantiate the uploader
    $('#file-dropzone').dropzone({
        url: "upload.php",
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2,// MB
        maxFiles: 2,
        acceptedFiles: ".bmp, .png, .jpg, .jpeg, .gif, .png",
        maxThumbnailFilesize: 5,
        addRemoveLink:true,
        init: function() {

            var thisDropzone = this;

            //Call the action method to load the images from the server
            $.getJSON("json.json").done(function (data) {
                console.log(data);
                if (data != '') {

                    $.each(data, function (index, item) {console.log(item);console.log(index);
                        //// Create the mock file:
                        var mockFile = {
                            name: item.file,
                            size: 10
                        };

                        // Call the default addedfile event handler
                        thisDropzone.emit("addedfile", mockFile);

                        // And optionally show the thumbnail of the file:
                        thisDropzone.emit("thumbnail", mockFile, item.file);

                        // If you use the maxFiles option, make sure you adjust it to the
                        // correct amount:
                        //var existingFileCount = 1; // The number of files already uploaded
                        //myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
                    });
                }

            });

            this.on('success', function(file, json) {
                console.log(json);
                console.log(file);
            });

            this.on('addedfile', function(file) {
                console.log(file);
                // Create the remove button
                var removeButton = Dropzone.createElement("<button>Remove file</button>");
                // Capture the Dropzone instance as closure.
                var _this = this;
                // Listen to the click event
                removeButton.addEventListener("click", function(e) {
                    // Make sure the button click doesn't submit the form:
                    e.preventDefault();
                    e.stopPropagation();

                    // Remove the file preview.
                    _this.removeFile(file);
                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.
                });
                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
            });

            this.on('drop', function(file) {
                alert('file');
            });
        }
    });
</script>