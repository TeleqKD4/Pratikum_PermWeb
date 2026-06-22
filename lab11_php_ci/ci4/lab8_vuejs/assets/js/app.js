// Konfigurasi Global URL API (Agar bisa dibaca otomatis oleh komponen Login.js)
window.apiUrl = 'http://localhost:8080';

// ==========================================
// 1. AXIOS INTERCEPTORS (Modul 14: Gembok API)
// ==========================================
// Berfungsi menyuntikkan Token secara otomatis ke setiap request data ke Backend
axios.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = 'Bearer ' + token;
    }
    return config;
}, error => {
    return Promise.reject(error);
});

// ==========================================
// 2. SAFE COMPONENT RESOLVER (Solusi Error "Home is not defined")
// ==========================================
// Mengamankan aplikasi agar tidak crash jika urutan pemanggilan script di index.html keliru
const MyHome = typeof Home !== 'undefined' ? Home : { 
    template: `
        <div class="content">
            <div class="card" style="text-align: center; padding: 3rem 1rem;">
                <h1 style="color: #4f46e5; margin-bottom: 10px;">Selamat Datang di SPA Praktikum</h1>
                <p style="color: #64748b; font-size: 1.1rem;">
                    Aplikasi Single Page Application dengan VueJS & CodeIgniter 4 API.
                </p>
                <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px auto; max-width: 200px;">
                <p>Silakan gunakan menu navigasi di atas untuk menjelajahi aplikasi.</p>
            </div>
        </div>
    ` 
};
const MyAbout = typeof About !== 'undefined' ? About : { template: '<div class="content"><div class="card"><h2>Halaman About</h2><p>Komponen About.js belum termuat sempurna.</p></div></div>' };
const MyArtikel = typeof Artikel !== 'undefined' ? Artikel : { template: '<div class="content"><div class="card"><h2>Halaman Artikel</h2><p>Komponen Artikel.js belum termuat sempurna.</p></div></div>' };
const MyLogin = typeof Login !== 'undefined' ? Login : { template: '<div class="content"><div class="card"><h2>Halaman Login</h2><p>Komponen Login.js belum termuat sempurna.</p></div></div>' };


// ==========================================
// 3. VUE ROUTER CONFIGURATION (Modul 12 & 13)
// ==========================================
const { createRouter, createWebHashHistory } = VueRouter;

const routes = [
    { path: '/', component: MyHome },
    { path: '/login', component: MyLogin },
    { path: '/artikel', component: MyArtikel, meta: { requiresAuth: true } }, // Diproteksi Satpam
    { path: '/about', component: MyAbout, meta: { requiresAuth: true } }     // Diproteksi Satpam
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});


// ==========================================
// 4. NAVIGATION GUARDS (Modul 13: Satpam Browser)
// ==========================================
// Memeriksa hak akses rute sebelum halaman dirender di browser klien
router.beforeEach((to, from, next) => {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    
    // Jika rute membutuhkan login (requiresAuth) tapi user belum login
    if (to.meta.requiresAuth && !isLoggedIn) {
        next('/login'); // Tendang paksa ke halaman login
    } else {
        next(); // Izinkan lewat
    }
});


// ==========================================
// 5. INISIALISASI UTAMA VUE APP INSTANCE
// ==========================================
const { createApp } = Vue;

const app = createApp({
    data() {
        return {
            // Reactive State untuk memantau status login tombol di Navbar index.html
            isLoggedIn: !!localStorage.getItem('isLoggedIn')
        }
    },
    methods: {
        logout() {
            // Hapus seluruh kredensial keamanan di local storage browser
            localStorage.removeItem('token');
            localStorage.removeItem('isLoggedIn');
            this.isLoggedIn = false;
            
            // Kembalikan ke halaman login dan segarkan sistem
            this.$router.push('/login');
            window.location.reload();
        }
    }
});

// Pasang sistem routing ke dalam aplikasi Vue
app.use(router);

// Kaitkan sistem ke elemen HTML ber-ID "app"
app.mount('#app');