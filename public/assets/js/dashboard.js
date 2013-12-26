$(document).ready(function()
    {
        $("#sessionTable").tablesorter();
        $("#subjectTable").tablesorter();
        refreshTable();
        function refreshTable(){
            $('#subjectTable').load('subject_table', function(){
                setTimeout(refreshTable, 15000);
            });
        }
    }
);