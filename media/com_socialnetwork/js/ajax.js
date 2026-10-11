<?php
declare(strict_types=1);

defined('_JEXEC') or die;
?>
const SocialNetworkAjax = {
    init() {
        document.querySelectorAll('.js-follow-user').forEach((button) => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                const targetId = button.dataset.targetId;
                const token = document.querySelector('input[name="' + (window.Joomla ? 'csrf_token' : 'token') + '"]')?.value || '';

                fetch('index.php?option=com_socialnetwork&task=ajax.follow&format=json', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new URLSearchParams({
                        target_id: targetId,
                        token: token
                    })
                })
                .then((response) => response.json())
                .then((result) => {
                    if (result && result.status === 'success') {
                        button.textContent = 'Following';
                        button.disabled = true;
                    }
                })
                .catch(() => {
                    console.warn('Social Network AJAX follow failed');
                });
            });
        });
    }
};

document.addEventListener('DOMContentLoaded', () => { SocialNetworkAjax.init(); });
