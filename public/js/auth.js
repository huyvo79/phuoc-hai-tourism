const Auth = {
    async login(username, password) {
        const response = await fetch('/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'include',
            body: JSON.stringify({ username, password })
        });
        return response.json();
    },

    async logout() {
        await fetch('/api/auth/logout', {
            method: 'POST',
            headers: { 'Accept': 'application/json' },
            credentials: 'include'
        });
        window.location.href = '/admin/login';
    },

    async getUser() {
        try {
            const response = await fetch('/api/auth/me', {
                method: 'GET',
                headers: { 'Accept': 'application/json' },
                credentials: 'include'
            });
            
            if (!response.ok) return null;
            
            const result = await response.json();
            return result.success ? result.data : null;
        } catch (error) {
            console.error('Get user failed:', error);
            return null;
        }
    },

    redirectToDashboard() {
        window.location.replace('/admin/dashboard');
    }
};
