window.EditableBlocks = function (config) {

    this.config = config;

    this.init = function () {
        console.log('EditableBlocks initing...');
        console.log(config);
    };
};

$(function () {
    var eb = new window.EditableBlocks(window.EditableBlocksConfig);
    eb.init();
});
