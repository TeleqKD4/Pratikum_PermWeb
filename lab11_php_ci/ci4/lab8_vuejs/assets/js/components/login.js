const Login = {
    template: `
        <div class="content">
            <div class="card" style="max-width: 400px; margin: 50px auto;">
                <h2>Login Administrator</h2>
                <form @submit.prevent="handleLogin">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Username</label>
                        <input type="text" v-model="username" class="form-control" required style="width: 100%; padding: 8px;">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Password</label>
                        <input type="password" v-model="password" class="form-control" required style="width: 100%; padding: 8px;">
                    </div>
                    <button type="submit" class="btn-login" style="width: 100%; padding: 10px; background: #4f46e5; color: white; border: none; border-radius: 5px;">Login</button>
                </form>
                <p v-if="error" style="color: red; margin-top: 10px;">{{ error }}</p>
            </div>
        </div>
    `,
    data() {
        return { username: '', password: '', error: '' }
    },
    methods: {
        handleLogin() {
            // Ganti URL ini sesuai backend CI4 kamu
            fetch('http://localhost:8080/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username: this.username, password: this.password })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 200) {
                    // Simpan Token & Status
                    localStorage.setItem('token', data.data.token);
                    localStorage.setItem('isLoggedIn', 'true');
                    this.$router.push('/artikel');
                } else {
                    this.error = data.messages;
                }
            })
            .catch(() => this.error = "Gagal terhubung ke Server");
        }
    }
};