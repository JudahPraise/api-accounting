import {
    getUrl,
    parentContainer,
    showAlert,
    getToken,
    callModal,
} from "./main.js";

$(function () {
    //Add user
    //Call modal
    $("#header_action").on("click", function (e) {
        e.preventDefault();
        callModal("create","accounts/create", null);
    });

    parentContainer().on("click", "#create_user", function (e) {
        e.preventDefault();
        callModal("create","accounts/create", null);
    });

    parentContainer().on("click", "#user_search_btn", function (e) {
        e.preventDefault();

        $("#user_search_form").trigger("submit");
    });

    parentContainer().on("submit", "#user_search_form", function (e) {
        e.preventDefault();

        let _token = $('input[name="_token"]').val();
        let search = $('input[name="search"]').val();

        $.ajax({
            url: getUrl("accounts/search"),
            type: "POST",
            data: {
                _token: _token,
                search: search,
            },
            beforeSend: function () {
                $("#user_search_spinner").removeClass("d-none");
                $("#users_result_container").removeClass("d-none");
            },
            success: function (response) {
                $("#users_result_wrapper").html(response.view);
                $("#user_search_spinner").addClass("d-none");
                addUser();
            },
            error: function (err) {
                console.log(err);
            },
        });
    });

    var userAddedCount = 0;
    var addedUsers = [];

    function addUser() {

        $(".user_add_btn").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();

                var added_user = $(this).parent().parent().parent();
                var user_id = $(this).data("id");
                var user = $(this);
                console.log(userAddedCount);
                console.log(addedUsers);
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: getUrl("accounts/store"),
                    type: "POST",
                    data: {
                        _token: _token,
                        user: user_id,
                    },
                    beforeSend: function () {},
                    success: function (response) {
                        if (response.status == 200) {

                            userAddedCount += 1;
                            user.html('<i class="bi bi-dash-lg text-danger"></i>');
                            user.removeClass("user_add_btn");
                            user.addClass("user_remove_btn");
                            user.parent().parent().parent().remove();
                            if (userAddedCount != 0) {
                                $("#users_added_container").removeClass("d-none");
                                $("#users_added_wrapper").append(added_user);
                            }
                            addedUsers.push(user_id);
                            removeUser();
                        } else if (response.staut == 400) {
                            showAlert("error", response.message);
                        } else if (response.status == 409) {
                            showAlert("info", response.message);
                        } else if(response.status == 410){
                            showAlert("info", response.message);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    },
                });
            });
        });
    }


    function removeUser(){
        $(".user_remove_btn").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();

                var _token = $('input[name="_token"]').val();
                var added_user = $(this).parent().parent().parent();
                var user_id = $(this).data("id");
                var user = $(this);

                console.log(userAddedCount);
                console.log(addedUsers);

                $.ajax({
                    url: getUrl("accounts/delete"),
                    type: "POST",
                    data: {
                        _token: _token,
                        id: user_id,
                    },
                    success: function (response) {
                        if (response.status == 200) {

                            userAddedCount -= 1;

                            user.removeClass("user_remove_btn");
                            user.addClass("user_add_btn");
                            user.html('<i class="bi bi-plus-lg"></i>');
                            user.parent().parent().parent().remove();

                            if (userAddedCount == 0) {
                                $("#users_added_container").addClass("d-none");
                                const getId = addedUsers.findIndex((object) => {
                                    return object.id === user_id;
                                });
                                addedUsers.splice(getId, 1);
                            }
                            $("#users_result_wrapper").append(added_user);
                        } else if (response.staut == 400) {
                            showAlert("error", response.message);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    },
                });
            });
        });
    }

    parentContainer().on("click", "#modal_save_btn", function (e) {
        e.preventDefault();

        $.ajax({
            url: getUrl("accounts/update-status"),
            type: "POST",
            data: {
                _token: getToken(),
                users: addedUsers,
            },
            beforeSend: function(){
            },
            success: function (response) {
                if(response.status == 200){
                    $("#main_modal").modal("hide");
                    showAlert(
                        "success",
                        response.message,
                    );
                } else {
                    showAlert("error", response.message);
                }
            },
        });
    });
});
