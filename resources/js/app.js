require('./bootstrap');

function toggleCompletion(taskItem) {
    const chk = taskItem.find('input[type=checkbox]');
    const isChecked = chk.prop('checked');
    const id = taskItem.data('id');
    console.log(id)

    chk.prop('checked', !isChecked);

    axios.put(route('task_toggle', {task: id}));

    if (!isChecked) {
        const dlg = $('#taskCompletedDialog');
        dlg.modal('show');

        const dlgCloseCounter = dlg.find('.dialog-close-counter');
        dlgCloseCounter.text(15);
        const timer = setInterval(() => {
            const current = Number.parseInt(dlgCloseCounter.text()) - 1;
            if (current < 0) {
                dlg.modal('hide');
            } else {
                dlgCloseCounter.text(current);
            }
        }, 1000);

        dlg.on('hide.bs.modal', () => {
            clearInterval(timer);

            window.location.reload();
        });
    } else {
        window.location.reload();
    }
}

$('.todo-checkbox').click(function(e) {
    e.preventDefault();

    toggleCompletion($(this.closest('.todo-item')));
});

$('.todo-item').click(function (e) {
    const target = $(e.target);
    if (target.closest('.todo-checkbox').length || target.closest('.todo-item-form').length)
        return;
    $(this).find('.todo-item-form').toggle();
});
