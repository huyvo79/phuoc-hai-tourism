document.addEventListener('DOMContentLoaded', async function() {
    const user = await Auth.getUser();
    if (user) {
        renderUserProfile(user);
    }
});

function renderUserProfile(user) {
    const elements = {
        sidebarUserName: user.name,
        sidebarUserRole: '@' + user.username,
        welcomeName: user.name,
        infoUsername: user.username,
        infoJoined: new Date(user.created_at).toLocaleDateString('vi-VN')
    };

    Object.entries(elements).forEach(([id, value]) => {
        const el = document.getElementById(id);
        if (el) el.innerText = value;
    });

    const avatar = document.getElementById('userAvatar');
    if (avatar) {
        avatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=8b5cf6&color=fff`;
    }
}

document.getElementById('logoutBtn')?.addEventListener('click', async function(e) {
    e.preventDefault();

    const result = await Swal.fire({
        title: 'Đăng xuất?',
        text: 'Bạn có chắc muốn đăng xuất khỏi hệ thống?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#8b5cf6',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Đăng xuất',
        cancelButtonText: 'Hủy',
        background: '#1e293b',
        color: '#fff'
    });

    if (result.isConfirmed) {
        await Auth.logout();
    }
});
