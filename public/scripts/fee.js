import {
    parentContainer,
    callModal,
    sendRequest,
    handleFormData,
    getUrl,
    getToken,
    loadData,
    showAlert,
    validateRequest,
    initForm,
} from "./main.js";

import {request} from './index.js'

handleSearchState();

parentContainer().on("click", '#add_fee_modal_btn', function (e) {
    e.preventDefault();
    callModal("create", "fees/create", null);
});

parentContainer().on("click", ".modal_save_btn", function (e) {
    e.preventDefault();
    $('#new_fee_form').trigger('submit');
});

parentContainer().on("submit", "#new_fee_form", function(e){
    e.preventDefault();

    var form = this;

    var formData = handleFormData(form);

    validateRequest(
        "fees/validate-request",
        form,
        sendRequest("fees/store", formData),
        loadData("fees/load-data", formData.type, "fees")
    );
});

parentContainer().on("change", "#fees_filter_select", function (e) {
    e.preventDefault()

    loadData("fees/load-data", $(this).val(), "fees");
    handleSearchState($(this).val());
});

parentContainer().on("click", ".fee-delete-btn", function(e){
    e.preventDefault();

    var id = $(this).data("id");
    var type = $(this).data("type");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                 url: getUrl("fees/delete"),
                 type: "POST",
                 data: {
                     _token: getToken(),
                     id: id,
                 },
                 success: function (response) {
                     if (response.status == 200) {
                         showAlert("success", response.message);
                         loadData("fees/load-data", type, "fees");
                     }
                 },
                 error: function (err) {
                     console.log(err);
                 },
            });
        }
    });
});

parentContainer().on("click", ".fee-edit-btn", function(e){
    e.preventDefault();

    var data = {
        _token: getToken(),
        id: $(this).data("id"),
        type: $(this).data("type"),
    };

    callModal("edit", "fees/edit", data, "type_wizard_page");

});

parentContainer().on("click", "#wizard-btn-confirm", function (e) {
    $("#edit_fee_form").trigger("submit");
});

parentContainer().on("submit", "#edit_fee_form", function(e){
    e.preventDefault();

    var form = this;
    
    var formData = handleFormData(form, $(this).data('id'));

    validateRequest(
        "fees/validate-request",
        form,
        sendRequest("fees/update", formData),
        loadData("fees/load-data", formData.type, "fees")
    );
});

// Form Wizard
parentContainer().on("click", 'input[name="account_type"]', function(e){
    e.preventDefault();

    createFee($(this));
});

function createFee(button){

    var type = button.val();

    var data = {
        _token: getToken(),
        type: type,
    };

    $.ajax({
        url: getUrl("fees/select-type"),
        type: "POST",
        data: data,
        dataType: "JSON",
        beforeSend: function () {},
        success: function (response) {
            $("#type_wizard_page").empty().append(response.view);
        },
        error: function (err) {
            console.log(err);
        },
    });

}

function handleSearchState(type){
    switch (type) {
        case '2':
            $("#seach-fee").attr("placeholder", "Search Other Fee");
            break;
    
        default:
            $("#seach-fee").attr("placeholder", "Search Assessment Fee");
            break;
    }
}

$("#seach-fee").keyup(function () {
    search_table($(this).val());
});

function search_table(value) {
     $("tbody tr").each(function () {

        var found = "false";

        $(this).each(function () {
            if (
                $(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0
            ) {
                found = "true";
            } 
        });

        if (found == "true") {
            $(this).show();
        } else {
            $(this).hide();
        }


    });
}  


    

