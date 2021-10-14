

(function ($) {
    "use strict";
    var mainApp = {
        slide_fun: function () {

            $('#carousel-example').carousel({
                interval:3000 
            })

        },
        dataTable_fun: function () {

            $('#dataTables-example').dataTable();

        },
       
        // custom_fun:function()
        // {

        // },

    }
   
    $(document).ready(function () {
        mainApp.slide_fun();
        mainApp.dataTable_fun();
        function showSnackBar() {
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");

            // Add the "show" class to DIV
            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){
                x.className = x.className.replace("show", "");
                location.reload();
            }, 1000);
        }

        $(document).on("click", "#delete", function() {
            $.ajax({
                url: "common/delete.php",
                type: "POST",
                cache: false,
                data:{
                    id: $("#id_d").val()
                },
                success: function(dataResult){
                    $('#deleteUserModal').modal('hide');
                    showSnackBar()
                }
            });
        });
        $(document).on("click", ".delete", function() {
            var id=$(this).attr("data-id");
            $('#id_d').val(id);
        });
    });
}(jQuery));


