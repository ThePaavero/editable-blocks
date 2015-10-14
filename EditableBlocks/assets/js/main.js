window.EditableBlocks = function () {
    this.init = function () {
        console.log('EditableBlocks initing...');
    };
};

$(function () {
    var eb = new window.EditableBlocks();
    eb.init();
});
