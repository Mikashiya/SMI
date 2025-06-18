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

    .filter-icon{
        cursor: pointer;
        padding-left: 8px;
    }

    .filter-overlay{
        position: absolute;
        display: none;
        background-color: #f8f8f8;
        border: #969696 2px solid;
        padding: 5px;
        z-index: 1;
        box-shadow: #969696;
        width: 50vh;
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

    document.querySelectorAll(".filter-overlay").forEach((el, index) => {
        el.addEventListener("click", (event) => toggleFilter(index, event));
    });

    function toggleFilter(index, event) {
        console.log("Function dipanggil untuk index:", index);

        let overlay = document.getElementById(`filter-${index}`);
        if (!overlay) {
            console.log("Overlay tidak ditemukan!");
            return;
        }

        let isVisible = overlay.style.display === "block";

        let rect = event.target.getBoundingClientRect();

        // Ambil parent terdekat yang memiliki posisi yang lebih stabil
        let parentRect = event.target.offsetParent?.getBoundingClientRect() || { left: 0, top: 0 };

        let viewportHeight = window.innerHeight;

        // Tutup semua overlay dulu
        document.querySelectorAll(".filter-overlay").forEach(filter => {
            filter.style.display = "none";
        });

        if (!isVisible) {
            console.log("Menampilkan overlay...");
            
            
            overlay.style.left = `${event.target.offsetLeft + (event.target.offsetWidth / 2) - (overlay.offsetWidth / 2)}px`;
            overlay.style.top = `${event.target.offsetTop + event.target.offsetHeight}px`;

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