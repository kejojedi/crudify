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

$(document).on('input', '.custom-file-input', function () {
    let files = [];

    for (let i = 0; i < $(this)[0].files.length; i++) {
        files.push($(this)[0].files[i].name);
    }

    $(this).next('.custom-file-label').html(files.join(', '));
});
