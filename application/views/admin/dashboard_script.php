<script>
    $(document).ready(function() {
        $('#recentAspirasiTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": true,
            "paging": true,
            "info": false,
            "order": [[ 6, "desc" ]],
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Cari aspirasi...",
                "zeroRecords": "Tidak ada data ditemukan",
                "paginate": {
                    "first": '<i class="fas fa-angle-double-left"></i>',
                    "last": '<i class="fas fa-angle-double-right"></i>',
                    "next": '<i class="fas fa-angle-right"></i>',
                    "previous": '<i class="fas fa-angle-left"></i>'
                }
            }
        });
    });
</script>
