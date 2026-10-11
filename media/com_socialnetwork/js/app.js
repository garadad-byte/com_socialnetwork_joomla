document.addEventListener('DOMContentLoaded', function () {
    const previewUrlInput = document.querySelector('input[name="link_url"]');
    if (previewUrlInput) {
        previewUrlInput.addEventListener('change', function () {
            const value = previewUrlInput.value.trim();
            if (!value || !/^https?:\/\//i.test(value)) {
                return;
            }

            fetch('index.php?option=com_socialnetwork&task=ajax.preview&format=json', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' },
                body: new URLSearchParams({ url: value })
            })
            .then(function (response) { return response.json(); })
            .then(function (result) {
                if (!result || !result.title) {
                    return;
                }
                const box = document.createElement('div');
                box.className = 'link-preview';
                box.innerHTML = '<strong>' + (result.title || 'Link') + '</strong><p>' + (result.description || '') + '</p>';
                previewUrlInput.parentNode.appendChild(box);
            })
            .catch(function () {
                return null;
            });
        });
    }
});
