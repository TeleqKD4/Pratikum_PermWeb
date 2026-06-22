const Artikel = {
template: `
    <div class="content">
        <h2>Daftar Artikel</h2>
        <div v-if="loading" class="card">Memuat data...</div>
        <div v-else>
            <div v-for="item in listArtikel" :key="item.id" class="card">
                <h3>{{ item.judul }}</h3>
                <p>Status: <small>Dipublish</small></p>
            </div>
        </div>
    </div>
`,
    data() {
        return {
            listArtikel: [],
            loading: true
        }
    },
    mounted() {
        // Panggil API CodeIgniter dari Modul 10
        fetch('http://localhost:8080/post')
            .then(res => res.json())
            .then(data => {
                this.listArtikel = data;
                this.loading = false;
            })
            .catch(err => {
                console.error("Gagal ambil data:", err);
                this.loading = false;
            });
    }
};