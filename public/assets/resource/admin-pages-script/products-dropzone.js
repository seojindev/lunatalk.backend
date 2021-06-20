Dropzone.autoDiscover = false;
DropzoneCreateMode = true;

$(function () {
    var dropzoneOption = {
        url: appServiceUrl  + '/api/v1/other/media/products/rep/create',
        addRemoveLinks: (dropzoneMode === 'create' || dropzoneMode === 'update') ? true : false,
        paramName: "media_file",
        clickable: (dropzoneMode === 'create' || dropzoneMode === 'update') ? true : false,
        // maxFiles:,
        uploadMultiple: false,
        autoProcessQueue: true,
        parallelUploads: 10,
        // addRemoveLinks: true,
        dictDefaultMessage: "",
        headers: {
            'Access-Control-Allow-Origin' : '*',
            'Accept': 'application/json',
            'Request-Client-Type' : serviceFrontCode,
            'Authorization' : 'Bearer ' + commonFunction.getCookie('access_token')
        },
        init: {}
    }

    // 상품 이미지 dropzone 옵션
    dropzoneOption.dictDefaultMessage = "상품 이미지를 올려 주세요.",
    dropzoneOption.init = function () {
        this.on("success", function(file, responseText) {
            productFormData.product_image.push(responseText.result.media_id);
        });

        this.on("complete", function(file) {
            $(".dz-remove").html("<div>삭제</div>");
        });

        this.on("removedfile", function (file) {
            var mediaId = '';
            if(file.mode === 'update') {
                mediaId = file.media_id
            } else {
                var response = JSON.parse(file.xhr.response);
                mediaId = response.result.media_id
            }

            productFormData.product_image = productFormData.product_image.filter((e) => e !== mediaId);

            if((dropzoneMode === 'update' || dropzoneMode === 'update' ) && productFormData.product_image.length > 0) {
                setTimeout(function(){ $("#dropzone_rep").addClass('dz-started'); }, 30);
            }
        });

        if(dropzoneMode === 'update' || dropzoneMode === 'detail') {
            pageData.images['repImage'].list.map((e) => {
                var mockFile = { mode:'update', name: e.original_name, size: e.size, media_id: e.media_id };
                this.options.addedfile.call(this, mockFile);
                this.options.thumbnail.call(this, mockFile, e.url);
                mockFile.previewElement.classList.add('dz-success');
                mockFile.previewElement.classList.add('dz-complete');

                mockFile.previewElement.addEventListener("click", function() {
                    window.open(e.url, "_BLANK");
                });
            });
            $(".dz-remove").html("<div>삭제</div>");
        }
    }

    // 상품 이미지
    $("div#dropzone_rep").dropzone(dropzoneOption);

    // 상품 상세 이미지 dropzone 옵션
    dropzoneOption.dictDefaultMessage = "상품 상세 이미지를 올려 주세요.",
    dropzoneOption.init = function () {
        this.on("success", function(file, responseText) {
            productFormData.product_detail_image.push(responseText.result.media_id);


        });

        this.on("complete", function(file) {
            $(".dz-remove").html("<div>삭제</div>");
        });

        this.on("removedfile", function (file) {
            var mediaId = '';
            if(file.mode === 'update') {
                mediaId = file.media_id
            } else {
                var response = JSON.parse(file.xhr.response);
                mediaId = response.result.media_id
            }

            productFormData.product_detail_image = productFormData.product_detail_image.filter((e) => e !== mediaId);

            if(dropzoneMode === 'update' && productFormData.product_detail_image.length > 0) {
                setTimeout(function(){ $("#dropzone_detail").addClass('dz-started'); }, 30);
            }
        });

        if(dropzoneMode === 'update' || dropzoneMode === 'detail') {
            pageData.images['detailImage'].list.map((e) => {
                var mockFile = { mode:'update', name: e.original_name, size: e.size, media_id: e.media_id };
                this.options.addedfile.call(this, mockFile);
                this.options.thumbnail.call(this, mockFile, e.url);
                mockFile.previewElement.classList.add('dz-success');
                mockFile.previewElement.classList.add('dz-complete');

                mockFile.previewElement.addEventListener("click", function() {
                    window.open(e.url, "_BLANK");
                });
            });
            $(".dz-remove").html("<div>삭제</div>");
        }
    }

    // 상품 상세 이미지
    $("div#dropzone_detail").dropzone(dropzoneOption);


    // 수성 및 상세 페이지 에서 이미지 싸이즈가 너무 커서 강제로 줄여줌.
    var thumbs = document.querySelectorAll('.dz-image');
    [].forEach.call(thumbs, function (thumb) {
        var img = thumb.querySelector('img');
        if (img) {
            img.setAttribute('width', '120px');
        }
    });

});
