<script>
    $(document).ready(function() {
        // Initialize DataTables
        var table = $('#laporanTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "dom": "<'row mb-3'<'col-md-6'B><'col-md-6'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "buttons": [
                {
                    extend: 'copy',
                    text: '<i class="fas fa-copy mr-1"></i> Copy',
                    className: 'btn btn-secondary btn-sm',
                    titleAttr: 'Salin ke Clipboard'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv mr-1"></i> CSV',
                    className: 'btn btn-info btn-sm',
                    titleAttr: 'Ekspor ke CSV'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel mr-1"></i> Excel',
                    className: 'btn btn-success btn-sm',
                    titleAttr: 'Ekspor ke Excel'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf mr-1"></i> PDF',
                    className: 'btn btn-danger btn-sm',
                    titleAttr: 'Ekspor ke PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-1"></i> Print',
                    className: 'btn btn-primary btn-sm',
                    titleAttr: 'Cetak Tabel'
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-eye mr-1"></i> Kolom',
                    className: 'btn btn-dark btn-sm'
                }
            ],
            "language": {
                "search": "Cari:",
                "paginate": {
                    "previous": "<i class='fas fa-angle-left'></i>",
                    "next": "<i class='fas fa-angle-right'></i>"
                }
            }
        });

        // Pindahkan container tombol agar terlihat lebih rapi (menghapus class default dt-buttons btn-group yang kadang bikin dempet jelek)
        table.buttons().container().appendTo('#laporanTable_wrapper .col-md-6:eq(0)');

        // --- Logika Filter Tanggal (Kode Lama Tetap Dipertahankan) ---
        const startDate = "<?= $start_date ?? '' ?>";
        const endDate = "<?= $end_date ?? '' ?>";
        const status = "<?= $selected_status ?? '' ?>";

        if (startDate || endDate || status) {
            const queryParams = new URLSearchParams({
                start_date: startDate,
                end_date: endDate,
                status: status
            });
            const printUrl = `<?= base_url('admin/laporan/cetak') ?>?${queryParams.toString()}`;
            $('#cetakBtn').attr('href', printUrl);
        }
    });
</script>