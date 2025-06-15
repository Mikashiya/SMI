<style>
    /* Custom CSS for SweetAlert2 */
    .custom-font{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('status'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Backup Success!',
        text: "Backup Time: {{ session('status', 'backup_time') }} Have a nice day",
        timer: 3000,
        showConfirmButton: false,
        customClass:{
            popup: 'custom-font'
        }
    });
    </script>
@endif

@if(session('success'))
    <script>
        Swal.fire({
            title: "SUCCESS",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 3000,
            showConfirmButton: false,
            customClass:{
                popup: 'custom-font'
            }
        });
    </script>
    @php session()->forget('success'); @endphp
@endif

@if(session('error'))
    <script>
        Swal.fire({
            title: "WARNING",
            text: "{{ session('error') }}",
            icon: "warning",
            timer: 3000,
            showConfirmButton: false,
            customClass:{
                popup: 'custom-font'
            }
        });
    </script>
    @php session()->forget('success'); @endphp
@endif

@if($errors->any())
    <script>
        Swal.fire({
            title: "Oops!",
            text: "{{ implode(', ', $errors->all()) }}",
            icon: "error",
            showConfirmButton: true,
            customClass:{
                popup: 'custom-font'
            }
        });
    </script>
@endif

<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        //console.log("Event listener aktif!"); // Debug sebelum eksekusi
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let partId = this.getAttribute('data-id');
            let form = this.closest("form");
            Swal.fire({
                title: "WARNING",
                html: `<p>This data will be deleted permanently</p><p>Proceed with caution</p>`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Proceed",
                cancelButtonText: "Cancel",
                customClass:{
                    popup: 'custom-font'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jalankan penghapusan menggunakan form
                }
            });
        });
    });

    document.querySelectorAll('.regist-btn').forEach(button => {
        //console.log("Event listener aktif!"); // Debug sebelum eksekusi
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let partId = this.getAttribute('data-id');
            let form = this.closest("form");
            Swal.fire({
                title: "WARNING",
                html: `<p>Ensure to cross check the information</p><p>Proceed with caution</p>`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Proceed",
                cancelButtonText: "Cancel",
                customClass:{
                    popup: 'custom-font'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); 
                }
            });
        });
    });
</script>