window.EditableBlocks = function (config) {

    this.config = config;
    this.blocks = $('.editable-blocks-content-block');

    this.bootUpBlocks = function () {
        this.blocks.each(function () {
            var block = $(this);
            block.data('content-on-load', block.html());
        });
    };

    this.activateBlock = function (contentBlockElement) {
        console.log('Activate');
    };

    this.deactivateBlock = function (contentBlockElement) {
        var currentContent = contentBlockElement.html();
        var originalContent = contentBlockElement.data('content-on-load');
        if (currentContent != originalContent) {
            var contentId = contentBlockElement.data('editable-blocks-content-id');
            contentBlockElement.addClass('editable-block-busy');
            this.sendUpdatedBlockContentToServer(contentId, currentContent, function (returnedContentString) {
                console.log('Saved!');
                contentBlockElement.html(returnedContentString);
                contentBlockElement.data('content-on-load', returnedContentString);
                contentBlockElement.removeClass('editable-block-busy');
            });
        }
    };

    this.sendUpdatedBlockContentToServer = function (contentId, contentString, callback) {
        $.ajax({
            type: 'POST',
            url: this.config.controllerEndpointUrl,
            data: 'contentId=' + contentId + '&content=' + encodeURIComponent(contentString),
            success: function (response) {
                callback(response);
            }
        });
    };

    this.doBlockListeners = function () {
        var me = this;
        this.blocks.on('focus', function (e) {
            e.preventDefault();
            me.activateBlock($(this));
        });
        this.blocks.on('blur', function (e) {
            e.preventDefault();
            me.deactivateBlock($(this));
        });
    };

    this.init = function () {
        console.log('EditableBlocks initing...');

        this.bootUpBlocks();
        this.doBlockListeners();
    };
};

$(function () {
    var eb = new window.EditableBlocks(window.EditableBlocksConfig);
    eb.init();
});
