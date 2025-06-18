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
        background-color: rgba(107, 107, 107, 0.3);
    }

    .filter-container{
        position: relative;
    }

    .filter-icon{
        cursor: pointer;
        padding-left: 8px;
        display: inline-flex;
    }

    .filter-overlay{
        position: absolute;
        display: none;
        background-color: #f8f8f8;
        border: #969696 2px solid;
        padding: 5px;
        z-index: 2;
        box-shadow: #969696;
        width: 50vh;
        position: absolute;
        top: 100%;
        left: 0;

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

    //document.querySelectorAll(".filter-overlay").forEach((el, index) => {
    //    el.addEventListener("click", (event) => toggleFilter(index, event));
    //});

    function toggleFilter(index) {
        let overlay = document.getElementById(`filter-${index}`);
        let icon = document.getElementById(`filter-icon-${index}`);

        if (!overlay) return;

        let isVisible = overlay.style.display === "block";

        // Tutup semua overlay lain
        document.querySelectorAll('.filter-overlay').forEach(el => el.style.display = "none");

        if (!isVisible) {
            let rect = icon.getBoundingClientRect();

            overlay.style.position = "fixed";  // 🚀 Kunci agar dia TIDAK "ikut" table
            overlay.style.top = `${rect.bottom}px`;  // Di bawah ikon
            overlay.style.left = `${rect.left}px`;   // Sejajar dengan ikon
            overlay.style.display = "block";
        }
    }

    function filterTable(colIndex, value) {
        let table = document.querySelector("table");
        let rows = table.querySelectorAll("tbody tr");

        rows.forEach(row => {
            let cell = row.cells[colIndex];

            // Gunakan `data-value` agar bisa membaca nomor otomatis
            let cellValue = cell.getAttribute("data-value") || cell.textContent.trim();

            row.style.display = cellValue.includes(value.trim()) ? "" : "none";
        });
    }
</script>