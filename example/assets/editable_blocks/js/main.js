window.EditableBlocks = function (config) {

    this.config = config;

    this.activateBlock = function (contentBlockElement) {
        console.log('Activate!');
    }

    this.deactivateBlock = function (contentBlockElement) {
        console.log('Deactivate!');
    }

    this.doBlockListeners = function () {
        var blocks = $('.editable-blocks-content-block');
        var me = this;
        blocks.on('focus', function (e) {
            e.preventDefault();
            me.activateBlock($(this));
        });
        blocks.on('blur', function (e) {
            e.preventDefault();
            me.deactivateBlock($(this));
        });
    }

    this.init = function () {
        console.log('EditableBlocks initing...');
        console.log(config);

        this.doBlockListeners();
    };
};

$(function () {
    var eb = new window.EditableBlocks(window.EditableBlocksConfig);
    eb.init();
});
