function clear()
    {
        var form = $("#add");
        form[0].reset();
         $("#button").val('Submit');
    }

  $("table").on("click","button#edit", function() {
        var textID = $(this).parent().siblings("#rid").text();
        var textName = $(this).parent().siblings("#rname").text();
        var textNum = $(this).parent().siblings("#rnum").text();
        $("#inputID").val(textID);
        $("#inputNum").val(textNum);
        $("#inputN").val(textName);
        $("#action").val('edit');
        $("#button").val('Edit');
    });

$(document).ready(function(){
loadTable();
function loadTable(){
    $.ajax({
        type: "POST",
        url: "controller/contact_controller.php",
        success: function(result) {
            var json = JSON.parse(result);
            $('#result').html(json.table);
            $('#inputID').val(json.separate);
        },
        error: function(result) {
            alert('error');
        }
    });
}
    
    $("#add").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "controller/contact_controller.php",
            data: $('#add').serialize(),
            success: function(response) {
                loadTable();
                clear();

            },
            error: function(result) {
                alert('error');
            }
        });
        
    });

    $("table").on("click", "#delete", function(e) {
           var textID = $(this).parent().siblings("#rid").text();
           $("#inputID").val(textID);
           $("#action").val('delete');
           var r = confirm("Are you sure you want to delete?");
            if(r == true) {
               $.ajax({
                type: "POST",
                url: "controller/contact_controller.php",
                data: $('#add').serialize(),
                success: function(response) {
                    loadTable();
                    clear();

                }
            });

            } else {
                loadTable();
                    clear();
            }
    });



});


