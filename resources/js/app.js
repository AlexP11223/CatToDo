require('./bootstrap');


$('.todo-checkbox').click(function () {
    const chk = $(this).find('input[type=checkbox]');
    chk.prop('checked', !chk.prop('checked'));
});
