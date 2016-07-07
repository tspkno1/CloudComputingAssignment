var idEditProduct;
var idEditGuest;
var idEditTypeProduct;
$(document).ready(function () {
    $('select').material_select();
    $('input#input_text, textarea#textarea1').characterCounter();
    $('.modal-trigger').leanModal();
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15,
        format: 'yyyy-mm-dd'});
    getAllGuest();
    getAllProduct();
    getProductforOder();
    getGuestforOder();
    getallTypeProduct();
    getallTypeProductList();
    getOder();
    $("#btnaddproduct").click(addProduct);
    $("#btnaddTypeProduct").click(addTypeProduct);
    $("#addTypeProduct").click(initValue);
    $("#btnaddCustomer").click(addGuest);
    $("#agreeEdit").click(editProduct);
    $("#disagreeEdit").click(disArgee);
    $("#agreeEditGuest").click(editGuest);
    $("#disagreeEditGuest").click(disArgee);
   $("#agreeEditTypeProduct").click(editTypeProduct);
    $("#disagreeEditTypeProduct").click(disArgee);
});
function getAllGuest() {
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'selectGuest': 'selectGuest'},
        success: function (response) {
            $('.tableGuest-ajax').html("");
            $('.tableGuest-ajax').html(response);
            $('.modal-trigger').leanModal();
        },
        error: function (response) {
            console.log(response);
        }
    });
}
function getallTypeProductforEdit() {
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'selectTypeProductforEdit': 'selectTypeProductforEdit'},
        success: function (response) {
            $('.editselectTypeProduct-ajax').html('');
            $('.editselectTypeProduct-ajax').html(response);
           
            $('select').material_select();
            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15,
                format: 'yyyy-mm-dd'});
        },
        error: function (response) {
            console.log(response);
        }
    });
}
function getGuestforOder() {
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'selectGuestOder': 'selectGuestOder'},
        success: function (response) {
            $('.selectGuestOder-ajax').html("");
            $('.selectGuestOder-ajax').html(response);
        },
        error: function (response) {
            console.log(response);
        }
    });
}
function addGuest() {
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'addGuest': 'addGuest',
            'nameCustomertxt': $('#nameCustomertxt').val(),
            'ageCustomertxt': $('#ageCustomertxt').val(),
            'addressCustomertxt': $('#addressCustomertxt').val(),
            'phoneCustomertxt': $('#phoneCustomertxt').val(),
            'emailCustomertxt': $('#emailCustomertxt').val()},
        success: function (response) {
            console.log(response);
            Materialize.toast('Thêm dữ liệu thành công!', 4000, 'rounded');
            getAllGuest();
        },
        error: function (response) {
            console.log(response);
        }
    });
}
function editGuest() {
    if ($('#editnameCustomertxt').val() == "" || $('#editageCustomertxt').val() == "" || $('#editaddressCustomertxt').val() == "" || $('#editphoneCustomertxt').val() == "") {
        Materialize.toast('Edit Guest cancel!', 4000, 'rounded');
    } else {
        $.ajax({
            type: 'post',
            url: 'function.php',
            data: {'editGuest': 'editGuest',
                'idEditGuest': idEditGuest,
                'editnameCustomertxt': $('#editnameCustomertxt').val(),
                'editageCustomertxt': $('#editageCustomertxt').val(),
                'editaddressCustomertxt': $('#editaddressCustomertxt').val(),
                'editemailCustomertxt': $('#editemailCustomertxt').val(),
                'editphoneCustomertxt': $('#editphoneCustomertxt').val()},
            success: function (response) {
                console.log(response);
                Materialize.toast('Edit Guest success!', 4000, 'rounded');
                getAllGuest();
            },
            error: function (response) {
                console.log(response);
                Materialize.toast('Edit Guest fail!', 4000, 'rounded');
            }
        });
    }
}
function delGuest(id) {
    var iddelGuest = id.substring(10);
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'delGuest': 'delGuest',
            'iddelGuest': iddelGuest},
        success: function (response) {
            console.log(response);
            var err = response.substring(6, 12);
            console.log(err);
            if (err == "Cannot") {
                Materialize.toast('Delete Guest Product fail! A foreign key constraint fails', 4000, 'rounded');
            }else{
                Materialize.toast('Delete Guest success!', 4000, 'rounded');
                getAllGuest();
            }
            
        },
        error: function (response) {
            console.log(response);
            Materialize.toast('Delete Guest fail!', 4000, 'rounded');
        }
    });
}
function getAllProduct() {
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'selectProduct': 'selectProduct'},
        success: function (response) {
            $('.tableProduct-ajax').html('');
            $('.tableProduct-ajax').html(response);
            $('.modal-trigger').leanModal();

        },
        error: function (response) {
            console.log(response);
        }
    });
}
function getedittypeProduct(id){
    idEditTypeProduct = id.substring(17);
    console.log(idEditTypeProduct);
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'getedittypeProduct': 'getedittypeProduct',
            'idEditTypeProduct': idEditTypeProduct},
        success: function (response) {
            console.log(response);
            $(".modaEditTypeProduct-ajax").html("");
            $(".modaEditTypeProduct-ajax").html(response);
             $("#edittypeproducttxt").focus();
        },
        error: function (response) {
            console.log(response);
            Materialize.toast('Get edit product fail!', 4000, 'rounded');
        }
    });
}
function editTypeProduct(){
     if ($('#edittypeproducttxt').val() == "" ) {
        Materialize.toast('Edit type product cancel!', 4000, 'rounded');
    } else {
        $.ajax({
            type: 'post',
            url: 'function.php',
            data: {'editTypeProduct': 'editTypeProduct',
                'idEditTypeProduct': idEditTypeProduct,
                'edittypeproducttxt': $('#edittypeproducttxt').val()},
            success: function (response) {
                console.log(response);
                Materialize.toast('Edit product success!', 4000, 'rounded');
                getallTypeProductList();
            },
            error: function (response) {
                console.log(response);
                Materialize.toast('Edit product fail!', 4000, 'rounded');
            }
        });
    }
}

function delTypeProduct(id) {
    var iddelTypeProduct = id.substring(16);
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'delTypeProduct': 'delTypeProduct',
            'iddelTypeProduct': iddelTypeProduct},
        success: function (response) {
            console.log(response);
            var err = response.substring(18, 24);
            if (err == "Cannot") {
                Materialize.toast('Delete Type Product fail! A foreign key constraint fails', 4000, 'rounded');
            } else {
                Materialize.toast('Delete Type Product success!', 4000, 'rounded');
                getallTypeProductList();
            }


        },
        error: function (response) {
            console.log(response);
            Materialize.toast('Delete Type Product fail!', 4000, 'rounded');
        }
    });
}
function getProductforOder() {
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'selectProductOder': 'selectProductOder'},
        success: function (response) {
            $('.selectProductOder-ajax').html("");
            $('.selectProductOder-ajax').html(response);
            $('select').material_select();
        },
        error: function (response) {
            console.log(response);
        }
    });
}
function addTypeProduct() {
    var name = $('#nameTypeProducttxt').val();
    if(name==""){
        $('#nameTypeProducttxt').focus();
        Materialize.toast('Input type!', 4000, 'rounded');
    }else{
         $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'addTypeProduct': 'addTypeProduct',
            'nameTypeProducttxt': $('#nameTypeProducttxt').val()},
        success: function (response) {
            console.log(response);
            Materialize.toast('Thêm dữ liệu thành công!', 4000, 'rounded');
            getallTypeProduct();
            getallTypeProductList();
        },
        error: function (response) {
            console.log(response);
        }
    });
    }
   
}
function getallTypeProduct() {
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'selectTypeProduct': 'selectTypeProduct'},
        success: function (response) {
            $('.selectTypeProduct-ajax').html('');
            $('.selectTypeProduct-ajax').html(response);
            $('select').material_select();

        },
        error: function (response) {
            console.log(response);
        }
    });
}

function getallTypeProductList() {
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'getallTypeProductList': 'getallTypeProductList'},
        success: function (response) {
            $('.tableTypeProduct-ajax').html('');
            $('.tableTypeProduct-ajax').html(response);
            getallTypeProduct();
            $('.modal-trigger').leanModal();
        },
        error: function (response) {
            console.log(response);
        }
    });
}
function addProduct() {
    if($('#nameProducttxt').val()==""||$('#manufDatetxt').val()==""||$('#priceProducttxt').val()==""||$('#selectTypeProduct').val()==null){
        Materialize.toast('Add product fail, please input text !!', 4000, 'rounded');
    }else{
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'addProduct': 'addProduct',
            'nameProducttxt': $('#nameProducttxt').val(),
            'manufDatetxt': $('#manufDatetxt').val(),
            'priceProducttxt': $('#priceProducttxt').val(),
            'selectTypeProduct': $('#selectTypeProduct').val()},
        success: function (response) {
            console.log(response);
            Materialize.toast('Add product success !', 4000, 'rounded');
            getAllProduct();

        },
        error: function (response) {
            console.log(response);
            Materialize.toast('Add product fail !!', 4000, 'rounded');
        }
    });}
}
function delProduct(id) {
    var iddelProduct = id.substring(12);
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'delProduct': 'delProduct',
            'iddelProduct': iddelProduct},
        success: function (response) {
                console.log(err);
                Materialize.toast('Delete product success!', 4000, 'rounded');
               getAllProduct();
        },
        error: function (response) {
            console.log(response);
            Materialize.toast('Delete product fail!', 4000, 'rounded');
        }
    });
}
function geteditProduct(id) {
    idEditProduct = id.substring(13);
    console.log(idEditProduct);
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'geteditProduct': 'geteditProduct',
            'idEditProduct': idEditProduct},
        success: function (response) {
            $(".modaEdit-ajax").html("");
            $(".modaEdit-ajax").html(response);
            $('#editpriceProducttxt').focus();
            $('#editnameProducttxt').focus();

            $('#editselectTypeProduct').focus();
            getallTypeProductforEdit();
        },
        error: function (response) {
            console.log(response);
            Materialize.toast('Get edit product fail!', 4000, 'rounded');
        }
    });
}
function editProduct() {
    if ($('#editnameProducttxt').val() == "" || $('#editmanufDatetxt').val() == "" || $('#editpriceProducttxt').val() == "" || $('#editselectTypeProduct').val() == null) {
        Materialize.toast('Edit product cancel!', 4000, 'rounded');
    } else {
        $.ajax({
            type: 'post',
            url: 'function.php',
            data: {'editProduct': 'editProduct',
                'idEditProduct': idEditProduct,
                'editnameProducttxt': $('#editnameProducttxt').val(),
                'editmanufDatetxt': $('#editmanufDatetxt').val(),
                'editpriceProducttxt': $('#editpriceProducttxt').val(),
                'editselectTypeProduct': $('#editselectTypeProduct').val()},
            success: function (response) {
                console.log(response);
                Materialize.toast('Edit product success!', 4000, 'rounded');
                getAllProduct();
            },
            error: function (response) {
                console.log(response);
                Materialize.toast('Edit product fail!', 4000, 'rounded');
            }
        });
    }
}
function geteditGuest(id) {
    idEditGuest = id.substring(11);
    console.log(idEditGuest);
    $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'geteditGuest': 'geteditGuest',
            'idEditguest': idEditGuest},
        success: function (response) {
            console.log(response);
            $(".modaEditGuest-ajax").html("");
            $(".modaEditGuest-ajax").html(response);
            $("#editphoneCustomertxt").focus();
            $("#editemailCustomertxt").focus();
            $("#editaddressCustomertxt").focus();
            $("#editageCustomertxt").focus();
            $("#editnameCustomertxt").focus();
        },
        error: function (response) {
            console.log(response);
            Materialize.toast('Get edit product fail!', 4000, 'rounded');
        }
    });
}
function initValue() {
    nameProducttxt = $('#nameProducttxt').val();
    manufDatetxt = $('#manufDatetxt').val();
    priceProducttxt = $('#priceProducttxt').val();
    selectTypeProduct = $('#selectTypeProduct').val();

    nameTypeProducttxt = $('#nameTypeProducttxt').val();

    nameCustomertxt = $('#nameCustomertxt').val();
    ageCustomertxt = $('#ageCustomertxt').val();
    addressCustomertxt = $('#addressCustomertxt').val();
    phoneCustomertxt = $('#phoneCustomertxt').val();
    emailCustomertxt = $('#emailCustomertxt').val();
    console.log(manufDatetxt);
}
function getOder(){
      $.ajax({
        type: 'post',
        url: 'function.php',
        data: {'selectOrder': 'selectOrder'},
        success: function (response) {
            $('.tableOder-ajax').html("");
            $('.tableOder-ajax').html(response);
        },
        error: function (response) {
            console.log(response);
        }
    });
}
function disArgee() {
    Materialize.toast('Edit was cancel!', 4000, 'rounded');
}
function clickAddProductOder() {

}
