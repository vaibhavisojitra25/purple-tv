function handleConfirmation(url, token) {
    notie.confirm({
        text: 'Are you sure you want to delete?',
        submitText: 'Yes Delete It!',
        cancelText: 'Cancel',
        submitCallback: function () {
            $.ajax({
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: token
                },
                url: url,
                success: function (data) {
                    toastr.success('Deleted Successfully');
                    tableData.ajax.reload();
                    // setTimeout(function () {
                    //     window.location.reload();
                    // }, 500);
                },
                error: function (data) {
                    toastr.error('Something went wrong');
                }
            });
        }
    });
}