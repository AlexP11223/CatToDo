require('./bootstrap');


$('.todo-checkbox').click(function () {
    const chk = $(this).find('input[type=checkbox]');
    chk.prop('checked', !chk.prop('checked'));
});

$('.todo-item').click(function (e) {
    const target = $(e.target);
    if (target.closest('.todo-checkbox').length || target.closest('.todo-item-form').length)
        return;
    $(this).find('.todo-item-form').toggle();
});
