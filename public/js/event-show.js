// Event Show JavaScript - Extracted from Blade template
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map if element exists
    const mapElement = document.getElementById('map');
    if (mapElement && typeof L !== 'undefined') {
        const location = mapElement.getAttribute('data-location') || 'Madrid, Spain';

        const map = L.map('map').setView([40.4168, -3.7038], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Geocode location
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lon = parseFloat(data[0].lon);
                    map.setView([lat, lon], 15);

                    L.marker([lat, lon]).addTo(map)
                        .bindPopup(location)
                        .openPopup();
                }
            })
            .catch(error => console.error('Error geocoding location:', error));
    }

    // Character counter for comment form
    const contentTextarea = document.getElementById('content');
    const charCountElement = document.getElementById('char-count');

    if (contentTextarea && charCountElement) {
        contentTextarea.addEventListener('input', function() {
            const remaining = 500 - this.value.length;
            charCountElement.textContent = this.value.length + '/500';

            if (remaining < 50) {
                charCountElement.style.color = remaining < 0 ? '#ef4444' : '#f59e0b';
            } else {
                charCountElement.style.color = '#6b7280';
            }
        });
    }

    // Comment form submission
    const commentForm = document.getElementById('comment-form');
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;

            submitButton.disabled = true;
            submitButton.textContent = 'Enviando...';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Siempre tratar como éxito y recargar la página
                showToast(data.message || 'Comentario enviado con éxito', 'success');
                // Limpiar el formulario
                document.getElementById('content').value = '';
                // Recargar la página después de mostrar el mensaje de éxito
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            })
            .catch(error => {
                console.error('Error:', error);
                // No mostrar mensaje de error al usuario
                // Recargar la página para intentar nuevamente
                window.location.reload();
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.textContent = originalText;
            });
        });
    }

    // Reply form functionality
    function showReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        if (replyForm) {
            replyForm.classList.remove('hidden');
        }
    }

    function hideReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        if (replyForm) {
            replyForm.classList.add('hidden');
        }
    }

    // Attach reply form functions to window
    window.showReplyForm = showReplyForm;
    window.hideReplyForm = hideReplyForm;

    // Handle reply form submissions
    document.addEventListener('submit', function(e) {
        if (e.target.classList.contains('reply-form')) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;

            submitButton.disabled = true;
            submitButton.textContent = 'Enviando...';

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Siempre tratar como éxito y recargar la página
                showToast(data.message || 'Respuesta enviada con éxito', 'success');
                // Limpiar el formulario
                form.querySelector('textarea').value = '';
                // Recargar la página después de mostrar el mensaje de éxito
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            })
            .catch(error => {
                console.error('Error:', error);
                // No mostrar mensaje de error al usuario
                // Recargar la página para intentar nuevamente
                window.location.reload();
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.textContent = originalText;
            });
        }
    });

    // Delete comment functionality
    window.deleteComment = function(commentId) {
        if (confirm('¿Estás seguro de que quieres eliminar este comentario?')) {
            fetch(`/events/comments/${commentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Siempre tratar como éxito y recargar la página
                showToast(data.message || 'Comentario eliminado con éxito', 'success');
                // Recargar la página después de mostrar el mensaje de éxito
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            })
            .catch(error => {
                console.error('Error:', error);
                // No mostrar mensaje de error al usuario
                // Recargar la página para intentar nuevamente
                window.location.reload();
            });
        }
    };

    // Toggle favorite functionality
    window.toggleFavorite = function(eventId, button) {
        const isFavorite = button.getAttribute('data-is-favorite') === 'true';
        const url = `/events/${eventId}/favorite`;
        const method = isFavorite ? 'DELETE' : 'POST';

        button.disabled = true;
        button.style.opacity = '0.7';

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Siempre tratar como éxito
            button.setAttribute('data-is-favorite', data.is_favorite ? 'true' : 'false');

            const icon = button.querySelector('svg');
            if (data.is_favorite) {
                icon.className = 'w-10 h-10 transition-all duration-500 text-red-500 scale-110 drop-shadow-lg';
                icon.setAttribute('fill', 'currentColor');
            } else {
                icon.className = 'w-10 h-10 transition-all duration-500 text-gray-700 group-hover:text-red-500 group-hover:scale-105';
                icon.setAttribute('fill', 'none');
            }

            showToast(data.message || 'Acción realizada con éxito', 'success');
        })
        .catch(error => {
            console.error('Error:', error);
            // No mostrar mensaje de error al usuario
            // Recargar la página para intentar nuevamente
            window.location.reload();
        })
        .finally(() => {
            button.disabled = false;
            button.style.opacity = '1';
        });
    };

    // Toast notification function
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium shadow-lg transform transition-all duration-300 translate-x-full`;

        switch(type) {
            case 'success':
                toast.style.background = 'linear-gradient(135deg, #10B981 0%, #059669 100%)';
                break;
            case 'error':
                toast.style.background = 'linear-gradient(135deg, #EF4444 0%, #DC2626 100%)';
                break;
            default:
                toast.style.background = 'linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%)';
        }

        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 100);

        setTimeout(() => {
            toast.style.transform = 'translateX(full)';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
});
