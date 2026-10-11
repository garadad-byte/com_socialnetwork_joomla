document.addEventListener('DOMContentLoaded', function () {
    const onSuccess = function (button, label) {
        if (button) {
            button.textContent = label;
            button.disabled = true;
        }
    };

    document.querySelectorAll('.js-follow-user').forEach(function (button) {
        button.addEventListener('click', function () {
            const targetId = button.getAttribute('data-target-id');
            const token = document.querySelector('input[name="' + (window.Joomla ? 'csrf_token' : 'token') + '"]')?.value || '';

            fetch('index.php?option=com_socialnetwork&task=ajax.follow&format=json', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' },
                body: new URLSearchParams({ target_id: targetId, token: token })
            })
            .then(function (response) { return response.json(); })
            .then(function (result) {
                if (result && result.status === 'success') {
                    onSuccess(button, 'Following');
                }
            })
            .catch(function () {
                console.warn('Follow action failed');
            });
        });
    });

    document.querySelectorAll('.js-social-post-form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(form);
            const body = new URLSearchParams();

            formData.forEach(function (value, key) {
                body.append(key, value.toString());
            });

            fetch('index.php?option=com_socialnetwork&task=ajax.post&format=json', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' },
                body: body
            })
            .then(function () {
                window.location.reload();
            });
        });
    });

    document.querySelectorAll('.js-comment-form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(form);
            const body = new URLSearchParams();
            formData.forEach(function (value, key) {
                body.append(key, value.toString());
            });

            fetch('index.php?option=com_socialnetwork&task=ajax.comment&format=json', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' },
                body: body
            })
            .then(function () {
                window.location.reload();
            });
        });
    });

    document.querySelectorAll('.js-reaction').forEach(function (button) {
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
            })
            .then(function (response) { return response.json(); })
            .then(function (result) {
                if (result && result.status === 'success') {
                    const count = result.count || 0;
                    button.textContent = '+1 (' + count + ')';
                }
            })
            .catch(function () {
                console.warn('Reaction failed');
            });
        });
    });
});
