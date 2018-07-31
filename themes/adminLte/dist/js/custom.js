function deleteConfirm() {
    return confirm("Are you sure, you want to delete the Data?");
}

function statusConfirm() {
    return confirm("Are you sure, you want to Change User Status?");
}

function deleteRecord(id,ctrlName){
    
        var confirmDelete = deleteConfirm();
        if(confirmDelete){
            $.ajax({
                    type: "POST",
                    url: ctrlName+'/delete',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        alert(data);
                        userSearch(); 
                    }
                });
        }
    }