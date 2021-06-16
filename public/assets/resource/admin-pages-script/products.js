Dropzone.autoDiscover = false;

$(document).ready(function() {
    $("#dropzone").dropzone({
        url: appMediaUrl  + '/media-upload',
        dictDefaultMessage: "이미지를 올려 주세요.",
        method: "POST",
        paramName: "media_file",
        method: "POST",
        withCredentials: false,
        headers: {
            'Access-Control-Allow-Origin' : '*',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Client-Token': appMediaClientToken,
            "Cache-Control": "",
        },
        init: function() {
            this.on("addedfile", function(file) {
                console.debug('addedfile', file);
            });

            this.on("sending", function(file, xhr, formData){
                    formData.append("media_name", "products");
                    formData.append("media_category", "upload");
            });

            // this.on("thumbnail", function(file,fileurl) {
            //     new_thumbnail_added(file);
            // });

            this.on("removedfile", function(file) {
                console.debug('removedfile', file);
            });
            // this.on("totaluploadprogress", function(progress) {
            //     display_progress(progress);
            // });

            // this.on("queuecomplete", function() {
            //     all_files_uploaded();
            // });
            //this.on("processing", function(file) { new_file_processed(file); });


            console.debug('dropzone init');
        }
    });
});
