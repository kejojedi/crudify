$.extend(true, $.fn.dataTable.defaults, {
    autoWidth: false,
    responsive: true,
    stateDuration: 0,
    stateSave: true,
    stateSaveParams: function (settings, data) {
        data.search.search = '';
        data.start = 0;
    },
    stateLoadCallback: function (settings, callback) {
        return JSON.parse(localStorage.getItem($(this).attr('id')));
    },
    stateSaveCallback: function (settings, data) {
        localStorage.setItem($(this).attr('id'), JSON.stringify(data));
    }
});
