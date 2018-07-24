$(document).ready(function () {
    function fetchData() {
        $.ajax({
            url: 'select.php',
            method: 'POST',
            success: function (data) {
                $('#task-data').html(data);
            }
        })
    }
    fetchData();

    $(document).on('click', '#btn-del', function () {
        var id = $(this).closest('tr').attr('data-id');
        var result = confirm('Are you sure that you want DELETE this?');
        if (result)
        {
            $.ajax({
                type: 'POST',
                url: 'delete.php',
                data: {id: id},
                success: function (data) {
                    console.log(data);
                    $(this).closest('tr').find('input[data-id=id]').remove();
                    fetchData();
                }
            });
        }
    });

    $(document).on('click', '#btn-upd', function () {
        var id = $(this).closest('tr').attr('data-id');
        var newDate = $(this).closest('tr').find('input[name="date"]').val();
        var newTask = $(this).closest('tr').find('input[name="task"]').val();
        if(newDate != '' && newTask != ''){
            var result = confirm('Are you sure that you want UPDATE this?');
            if(result)
            {
                $.ajax({
                    type: 'POST',
                    url: 'update.php',
                    data: {'id':id, 'updDate': newDate, 'updTask': newTask},
                    success: function (data) {
                        fetchData();
                    }
                });
            }
        }
        else {
            $('#error-data').html("you can't save empty fields").show('fast');
            setTimeout(function () {
                $("#error-data").fadeOut('fast');
            }, 1500);
        }
    });

    $(document).on('click', '#btn-new', function () {
        var newDate = $('input[name="new-dateTime"]').val();
        var newTask = $('input[name="new-task"]').val();
        if(newDate != '' && newTask != '') {
            $.ajax({
                type: 'POST',
                url: 'insert.php',
                data: {newDate: newDate, newTask: newTask},
                success: function (data) {
                    console.log(data);
                    fetchData();
                }
            });
        }
        else {
            $('#error-data').html('you need to fill fields').show('fast');
            setTimeout(function () {
                $("#error-data").fadeOut('fast');
            }, 1500);
        }
    });
});