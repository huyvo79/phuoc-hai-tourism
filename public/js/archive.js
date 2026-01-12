  const checkboxes = document.querySelectorAll('.filter-checkbox');
        const posts = document.querySelectorAll('.post-card');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', filterPosts);
        });

        function filterPosts() {
            const checked = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            posts.forEach(post => {
                const category = post.dataset.category;

                if (checked.length === 0 || checked.includes(category)) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        }