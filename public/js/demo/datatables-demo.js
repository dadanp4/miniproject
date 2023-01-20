
$.extend( $.fn.dataTable.defaults, {
    searching: false,
    // ordering:  false,
    // select: false
} );

$('#dataTable').dataTable(
{
    "paging": true,
    "lengthMenu": [ 5 ],
}
);

