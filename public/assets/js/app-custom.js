$(function() {
    const jsDataTable = $('.datatable-table')
    if(jsDataTable.length) {
        jsDataTable.DataTable({
            pageLength: 100,
            lengthChange: false,
            ordering: false,
            language: {
                // info: "Hiển thị _START_ đến _END_ của _TOTAL_",
                info: "",
                infoEmpty: "",
                emptyTable: "",
                search: "Tìm kiếm",
                paginate: {
                    first:      "<<",
                    last:       ">>",
                    next:       ">",
                    previous:   "<"
                },
            }
        });
    }
})

var perPage = 10;

//Table
var options = {
    valueNames: [
        "id",
        "customer_name",
        "email",
        "date",
        "phone",
        "status",
    ],
    page: perPage,
    pagination: true,
    plugins: [
        ListPagination({
            left: 2,
            right: 2
        })
    ]
};

function initTableJs(idTableEl, valuNames) {
    options.valueNames = valuNames
    var jsTable = new List(idTableEl, options).on("updated", function (list) {
        list.matchingItems.length == 0 ?
            (document.getElementsByClassName("noresult")[0].style.display = "block") :
            (document.getElementsByClassName("noresult")[0].style.display = "none");
        var isFirst = list.i === 1;
        var isLast = list.i > list.matchingItems.length - list.page;
        // make the Prev and Nex buttons disabled on first and last pages accordingly
        (document.querySelector(".pagination-prev.disabled")) ? document.querySelector(".pagination-prev.disabled").classList.remove("disabled"): '';
        (document.querySelector(".pagination-next.disabled")) ? document.querySelector(".pagination-next.disabled").classList.remove("disabled"): '';
        if (isFirst) {
            document.querySelector(".pagination-prev").classList.add("disabled");
        }
        if (isLast) {
            document.querySelector(".pagination-next").classList.add("disabled");
        }
        if (list.matchingItems.length <= perPage) {
            document.querySelector(".pagination-wrap").style.display = "none";
        } else {
            document.querySelector(".pagination-wrap").style.display = "flex";
        }

        if (list.matchingItems.length === perPage) {
            document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click()
        }

        if (list.matchingItems.length > 0) {
            document.getElementsByClassName("noresult")[0].style.display = "none";
        } else {
            document.getElementsByClassName("noresult")[0].style.display = "block";
        }
    });
}

var checkAll = document.getElementById("checkAll");
if (checkAll) {
    checkAll.onclick = function () {
        console.log('dadasd');
        var checkboxes = document.querySelectorAll('.form-check-all input[type="checkbox"][name="ids"]');
        if (checkAll.checked == true) {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = true;
                checkbox.closest("tr").classList.add("table-active");
            });
        } else {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = false;
                checkbox.closest("tr").classList.remove("table-active");
            });
        }
    };
}

function deleteMultiple(url) {
    let ids_array = [];
    var items = document.getElementsByName('ids');
    items.forEach(function (ele) {
        if (ele.checked === true) {
            ids_array.push(ele.value);
        }
    });

    if (typeof ids_array !== 'undefined' && ids_array.length > 0) {
        Swal.fire({
            title: swalTitle,
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#51d28c",
            cancelButtonColor: "#f34e4e",
            confirmButtonText: swalConfirmButtonText,
            cancelButtonText: swalCancelButtonText
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').content,
                        ids: ids_array
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response)
                        alertNoti('success', response.msg);
                        window.location.reload()
                    },
                    error: function(response, status, error) {
                        alertNoti('error', response.responseJSON.msg);
                    }
                });
            } else {
                return false;
            }
        })
    } else {
        Swal.fire({
            title: swalTitleCheckIdDelete,
            icon: "warning",
            confirmButtonClass: 'swal2-cancel swal2-styled swal2-default-outline',
            showCloseButton: true,
            confirmButtonColor: "#f34e4e",
            confirmButtonText: swalConfirmButtonText,
        });
    }
}

function generatePassword (){
    let passwordGenerated = '';
    length = 16;
    wishlist = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz~!@-#$';
     
    return Array.from(crypto.getRandomValues(new Uint32Array(length)))
        .map((x) => wishlist[x % wishlist.length])
        .join('');
}
