document.addEventListener('DOMContentLoaded', function () {
    const postForms = document.querySelectorAll('.js-social-post-form');
    postForms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const body = new URLSearchParams();
            new FormData(form).forEach(function (value, key) {
                body.append(key, String(value));
            });

            fetch('index.php?option=com_socialnetwork&task=ajax.post&format=json', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' },
                body: body
            }).then(function () {
                window.location.reload();
            });
        });
    });

    const commentForms = document.querySelectorAll('.js-comment-form');
    commentForms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const body = new URLSearchParams();
            new FormData(form).forEach(function (value, key) {
                body.append(key, String(value));
            });

            fetch('index.php?option=com_socialnetwork&task=ajax.comment&format=json', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' },
                body: body
            }).then(function () {
                window.location.reload();
            });
        });
    });

    const reactionButtons = document.querySelectorAll('.js-reaction');
    reactionButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const body = new URLSearchParams({
                entity_type: button.getAttribute('data-entity-type') || 'post',
                entity_id: button.getAttribute('data-entity-id') || '0',
                reaction: button.getAttribute('data-reaction') || 'plusone'
            });

            fetch('index.php?option=com_socialnetwork&task=ajax.reaction&format=json', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' },
                body: body
            }).then(function (response) {
                return response.json();
            }).then(function (result) {
                if (result && result.status === 'success') {
                    button.textContent = '+1 (' + (result.count || 0) + ')';
                    button.disabled = true;
                }
            });
        });
    });
});
