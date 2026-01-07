const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword?.addEventListener('click', () => {
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;
    togglePassword.innerHTML = `<i class="fas fa-eye${type === 'password' ? '' : '-slash'}"></i>`;
});

document.getElementById('loginForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorAlert = document.getElementById('error-alert');
    const errorMessage = document.getElementById('error-message');

    errorAlert.classList.add('hidden');
    setLoading(true);

    try {
        const data = await Auth.login(username, password);

        if (data.success) {
            setSuccess();
            setTimeout(() => Auth.redirectToDashboard(), 500);
        } else {
            errorMessage.innerText = data.message || 'Đăng nhập thất bại';
            errorAlert.classList.remove('hidden');
            setLoading(false);
        }
    } catch (error) {
        errorMessage.innerText = 'Có lỗi xảy ra, vui lòng thử lại.';
        errorAlert.classList.remove('hidden');
        setLoading(false);
    }
});

function setLoading(loading) {
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');
    const btnSpinner = document.getElementById('btnSpinner');

    submitBtn.disabled = loading;
    btnText.innerText = loading ? 'Đang xử lý...' : 'Đăng Nhập';
    btnIcon.classList.toggle('hidden', loading);
    btnSpinner.classList.toggle('hidden', !loading);
}

function setSuccess() {
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');
    const btnSpinner = document.getElementById('btnSpinner');

    btnText.innerText = 'Thành công!';
    btnSpinner.classList.add('hidden');
    btnIcon.className = 'fas fa-check';
    btnIcon.classList.remove('hidden');
}
