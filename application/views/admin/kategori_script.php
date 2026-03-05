<script>
$(document).ready(function () {
    // Inisialisasi DataTable
    var table = $('#kategoriTable').DataTable({
        "destroy": true, // Menghindari error reinitialise
        "responsive": true,
        "autoWidth": false,
        "lengthChange": true,
        "ordering": true,
        "dom": "<'row mb-3'<'col-md-6'l><'col-md-6 text-right'f>>" +
               "<'row'<'col-12'tr>>" +
               "<'row mt-3'<'col-md-5'i><'col-md-7'p>>",
        "language": {
            "search": "",
            "searchPlaceholder": "Cari kategori...",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            "infoEmpty": "Data tidak tersedia",
            "zeroRecords": "Kategori tidak ditemukan",
            "paginate": {
                "previous": "<i class='fas fa-angle-left'></i>",
                "next": "<i class='fas fa-angle-right'></i>"
            }
        }
    });

    // Script khusus untuk Halaman Laporan (Jika tabelnya adalah laporanTable)
    if ($('#laporanTable').length) {
        $('#laporanTable').DataTable({
            "destroy": true,
            "responsive": true,
            "dom": "<'row mb-3'<'col-md-6'B><'col-md-6 text-right'f>>" +
                   "<'row'<'col-12'tr>>" +
                   "<'row mt-3'<'col-md-5'i><'col-md-7'p>>",
            "buttons": [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel mr-1"></i> Excel',
                    className: 'btn btn-success btn-sm'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf mr-1"></i> PDF',
                    className: 'btn btn-danger btn-sm'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-1"></i> Print',
                    className: 'btn btn-primary btn-sm'
                }
            ]
        });
    }
});
</script>