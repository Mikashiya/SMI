<style>
    .filter-btn{
        padding: 5px;
        right: 1.5%;
        background-color: #ebebeb;
        border: #424242 1px solid;
        cursor: pointer;
        transition: .5s;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        z-index: 1;
    }

    .filter-btn:hover{
        box-shadow: 4px 4px #7B95F9;
    }

    .filter-icon{
        cursor: pointer;
        padding-left: 8px;
    }

    .filter-overlay{
        top: 20%;
        position: absolute;
        display: none;
        background-color: #ebebeb;
        border: #969696 2px solid;
        padding: 5px;
        z-index: 1;
        box-shadow: #969696;
        margin-left: 30vh;
    }

    .filter-overlay p{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .filter-overlay input{
        width: 30vh;
        padding: 5px;
    }
</style>
<button onclick="resetFilters()" class="filter-btn">Reset Filter</button>
<script>
    function resetFilters() {
        // Kosongkan semua input filter
        document.querySelectorAll(".filter-overlay input").forEach(input => {
            input.value = "";
        });

        // Tampilkan kembali semua baris tabel
        document.querySelectorAll("tbody tr").forEach(row => {
            row.style.display = "";
        });

        // Tutup semua filter overlay
        document.querySelectorAll(".filter-overlay").forEach(filter => {
            filter.style.display = "none";
        });
    }

    function toggleFilter(index) {
        let overlay = document.getElementById(`filter-${index}`);

        // Cek apakah overlay sedang terlihat
        let isVisible = overlay.style.display === "block";

        // Tutup semua overlay dulu
        document.querySelectorAll(".filter-overlay").forEach(filter => {
            filter.style.display = "none";
        });

        // Jika overlay yang ditekan tadinya tertutup, maka buka kembali
        if (!isVisible) {
            let rect = event.target.getBoundingClientRect();
            overlay.style.display = "block";
        }
    }

    function filterTable(colIndex, value) {
        let table = document.querySelector("table");
        let rows = table.querySelectorAll("tbody tr");
        
        rows.forEach(row => {
            let cell = row.cells[colIndex];
            row.style.display = cell.textContent.toLowerCase().includes(value.toLowerCase()) ? "" : "none";
        });
    }
</script>