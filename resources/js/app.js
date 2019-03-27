require('./bootstrap');

function toggleCompletion(taskItem) {
    const chk = taskItem.find('input[type=checkbox]');
    const isChecked = chk.prop('checked');
    const id = taskItem.data('id');

    chk.prop('checked', !isChecked);

    axios.put(route('task_toggle', {task: id})).then(() => {
        if (isChecked) {
            window.location.reload();
        }
    });

    if (!isChecked) {
        const dlg = $('#taskCompletedDialog');
        const dlgImg = dlg.find('.cat-img');

        let timer = null;

        axios.get(route('random_cat')).then(response => {
            console.log(response);
            dlgImg.attr('src', response.data.url);

            dlg.find('.dialog-close-counter').show();
            const dlgCloseCounterValue = dlg.find('.dialog-close-counter-value');
            dlgCloseCounterValue.text(15);
            timer = setInterval(() => {
                const current = Number.parseInt(dlgCloseCounterValue.text()) - 1;
                if (current < 0) {
                    dlg.modal('hide');
                } else {
                    dlgCloseCounterValue.text(current);
                }
            }, 1000);
        });

        dlg.modal('show');

        dlg.on('hide.bs.modal', () => {
            clearInterval(timer);

            window.location.reload();
        });
    }
}

$('.todo-checkbox').click(function(e) {
    e.preventDefault();

    toggleCompletion($(this).closest('.todo-item'));
});

const taskItems = $('.todo-item');

taskItems.toArray().forEach(taskItem => {
    const mc = new Hammer(taskItem);
    mc.on('swipeleft swiperight', e => {
        $(taskItem).addClass(e.type);

        setTimeout(() => {
            $(taskItem).hide();
            toggleCompletion($(taskItem).closest('.todo-item'));
        }, 300);
    });
});

taskItems.click(function (e) {
    const target = $(e.target);
    if (target.closest('.todo-checkbox').length || target.closest('.todo-item-form').length)
        return;
    $(this).find('.todo-item-form').toggle();
});
