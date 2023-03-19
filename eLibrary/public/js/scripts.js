
$(document).ready(function(){

    $("#authorsTable").DataTable({
        processing: true,
        serverSide: true,
        ajax : "/authors",
        dataSrc: "data",
        lengthMenu: [ [5,10, 25,    50, -1], [5,10, 25, 50, "All"] ],
        order: [[4, 'desc']],
        columns: [
            { data: "src",
              render: function(data, type, full, meta){
                if(data){
                    return `<img src="${data}" alt="" style="width: 50px;"></img>`;
                }else{
                    return `/`
                }
              }
            },
            { data: "name" },
            { data: "surname" },
            { data: "created_by", orderable: false },
            { data: "created_at" },
            { data: "updated_at" },
            { data: "id",
              render: function (data, type) {
                return `<i class="fa fa-trash delete-icon author-delete" data-id="${data}" aria-hidden="true"></i>`;
            }},
        ]
    })

    $("#booksTable").DataTable({
        processing: true,
        serverSide: true,
        ajax : "/books",
        dataSrc: "data",
        lengthMenu: [ [5,10, 25, 50, -1], [5,10, 25, 50, "All"] ],
        order: [[5, 'desc']],
        columns: [
            { data: "title" },
            { data: "description" },
            { data: "book_number" },
            { data: "author", orderable: false },
            { data: "created_by", orderable: false },
            { data: "created_at" },
            { data: "updated_at" },
            { data: "id",
              render: function (data, type) {
                return `<i class="fa fa-trash delete-icon book-delete" data-id="${data}" aria-hidden="true"></i>`;
            }},
        ]
    })

    $("#usersTable").DataTable({
        processing: true,
        serverSide: true,
        ajax : "/users",
        dataSrc: "data",
        lengthMenu: [ [5,10, 25, 50, -1], [5,10, 25, 50, "All"] ],
        order: [[5, 'desc']],
        columns: [
            { data: "name" },
            { data: "surname" },
            { data: "email" },
            { data: "role", orderable: false },
            { data: "created_by", orderable: false },
            { data: "created_at" },
            { data: "updated_at" },
            { data: "id",
              render: function (data, type) {
                return `<i class="fa fa-trash delete-icon user-delete" data-id="${data}" aria-hidden="true"></i>`;
            }, orderable: false},
        ]
    })

    let roleId = $("#roleId").val();
   
    if(roleId && roleId!=1){
        $("#booksTable").DataTable().column(7).visible(false)
    }
    
})

$(document).on("click",".author-delete",function(){
    let id = $(this).data("id");
    $("#deleteAuthor").modal("show");
    $("#deleteAuthorButton").data("id",id);
})

$(document).on("click","#deleteAuthorButton",function(){
    let id = $(this).data("id");
    let token = $("input[name='_token']").val();

    $.ajax({
        url: '/authors/'+id,
        method: "DELETE",
        data:{
            _token: token,
        },
        success: function(data){
            console.log(data)
            $("#authorsTable").DataTable().ajax.reload();
            $("#deleteAuthor").modal("hide");
        },
        error: function(xhr){

        }
    })
 
})

$(document).on("click",".book-delete",function(){
    let id = $(this).data("id");
    $("#deleteBook").modal("show");
    $("#deleteBookButton").data("id",id);
})

$(document).on("click","#deleteBookButton",function(){
    let id = $(this).data("id");
    let token = $("input[name='_token']").val();
    
    $.ajax({
        url: '/books/'+id,
        method: "DELETE",
        data:{
            _token: token,
        },
        success: function(data){
            console.log(data)
            $("#booksTable").DataTable().ajax.reload();
            $("#deleteBook").modal("hide");
        },
        error: function(xhr){

        }
    })
 
})


$(document).on("click",".user-delete",function(){
    let id = $(this).data("id");
    $("#deleteUser").modal("show");
    $("#deleteUserButton").data("id",id);
})

$(document).on("click","#deleteUserButton",function(){
    let id = $(this).data("id");
    let token = $("input[name='_token']").val();
    
    $.ajax({
        url: '/users/'+id,
        method: "DELETE",
        data:{
            _token: token,
        },
        success: function(data){
            console.log(data)
            $("#usersTable").DataTable().ajax.reload();
            $("#deleteUser").modal("hide");
        },
        error: function(xhr){

        }
    })
 
})