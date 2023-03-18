
$(document).ready(function(){

    $("#example").DataTable({
        // processing: true,
        // serverSide: true,
        // ajax : "/api/myData",
    });

    $("#authorsTable").DataTable({
        processing: true,
        serverSide: true,
        ajax : "/authors",
        dataSrc: "data",
        lengthMenu: [ [5,10, 25, 50, -1], [5,10, 25, 50, "All"] ],
        columns: [
            { data: "src" },
            { data: "name" },
            { data: "surname" },
            { data: "created_by" },
            { data: "created_at" },
            { data: "updated_at" }
        ]
    })
})

