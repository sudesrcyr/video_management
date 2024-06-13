$(document).ready(function() {
    function loadTable() {
        var table = $("#video tbody");

        $.post("page2get.php", function(response) {
            console.log(response); 
            table.empty(); 

            if (response.length > 0) {
                response.forEach(function(row) {
                    var newRow = `
                         <tr>
                        <td>${row.id}</td>
                        <td>${row.link}</td>
                        <td>${row.description}</td>
                        <td>${row.date_added}</td>
                        <td>${row.is_deleted}</td>
                    </tr>
                    `;
                    table.append(newRow);
                });

                // Delete button 
                $(".delete-btn").off('click').on('click', function() {
                    var id = $(this).data("id");
                    deleteVideo(id);
                });
            } else {
                table.append('<tr><td colspan="3">No Data</td></tr>');
            }
        }).fail(function() {
            table.append('<tr><td colspan="3">An error occurred</td></tr>');
        });
    }

    function deleteVideo(id) {
        if (confirm("Are you sure you want to delete this video?")) {
            $.post("delete_video.php", { id: id }, function(response) {
                alert(response);
                loadTable(); 
            }).fail(function() {
                alert("An error occurred while deleting the video.");
            });
        }
    }

    loadTable();
});




