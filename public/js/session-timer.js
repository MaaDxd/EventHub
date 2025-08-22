/**
 * Session Timer - Manages user session timeout and inactivity detection
 */
class SessionTimer {
    constructor(options = {}) {
        this.sessionTimeout = options.sessionTimeout || 15 * 60 * 1000; // 15 minutes in milliseconds
        this.warningTime = options.warningTime || 2 * 60 * 1000; // 2 minutes warning
        this.checkInterval = options.checkInterval || 30 * 1000; // Check every 30 seconds
        
        this.lastActivity = Date.now();
        this.warningShown = false;
        this.intervalId = null;
        this.warningTimeoutId = null;
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.startTimer();
        console.log('Session timer initialized - Timeout:', this.sessionTimeout / 1000 / 60, 'minutes');
    }

    bindEvents() {
        // Events that indicate user activity
        const events = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'];
        
        events.forEach(event => {
            document.addEventListener(event, () => this.resetTimer(), true);
        });

        // Handle page visibility changes
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                this.checkSessionStatus();
            }
        });
    }

    resetTimer() {
        this.lastActivity = Date.now();
        this.warningShown = false;
        this.hideWarningModal();
    }

    startTimer() {
        this.intervalId = setInterval(() => {
            this.checkTimeout();
        }, this.checkInterval);
    }

    checkTimeout() {
        const now = Date.now();
        const timeSinceLastActivity = now - this.lastActivity;
        const timeUntilTimeout = this.sessionTimeout - timeSinceLastActivity;

        // Show warning if approaching timeout
        if (timeUntilTimeout <= this.warningTime && !this.warningShown) {
            this.showWarningModal(Math.ceil(timeUntilTimeout / 1000));
            this.warningShown = true;
        }

        // Logout if timeout reached
        if (timeSinceLastActivity >= this.sessionTimeout) {
            this.logout('Sesión expirada por inactividad');
        }
    }

    async checkSessionStatus() {
        try {
            const response = await fetch('/session/status');
            const data = await response.json();
            
            if (!data.authenticated) {
                this.logout('Sesión no válida');
                return;
            }

            // Update timer based on server response
            if (data.remaining_seconds <= 0) {
                this.logout('Sesión expirada');
            } else if (data.remaining_seconds <= this.warningTime / 1000 && !this.warningShown) {
                this.showWarningModal(data.remaining_seconds);
                this.warningShown = true;
            }
        } catch (error) {
            console.error('Error checking session status:', error);
        }
    }

    showWarningModal(secondsRemaining) {
        // Remove existing modal if any
        this.hideWarningModal();

        const modal = document.createElement('div');
        modal.id = 'session-warning-modal';
        modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50';
        
        modal.innerHTML = `
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">⚠️ Sesión por Expirar</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            Tu sesión expirará en <span id="countdown" class="font-bold text-red-600">${secondsRemaining}</span> segundos por inactividad.
                        </p>
                        <p class="text-sm text-gray-500 mt-2">
                            ¿Deseas continuar con tu sesión?
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button id="extend-session" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-24 mr-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Sí, continuar
                        </button>
                        <button id="logout-now" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cerrar sesión
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Start countdown
        this.startCountdown(secondsRemaining);

        // Bind events
        document.getElementById('extend-session').addEventListener('click', () => {
            this.extendSession();
        });

        document.getElementById('logout-now').addEventListener('click', () => {
            this.logout('Sesión cerrada por el usuario');
        });
    }

    startCountdown(seconds) {
        const countdownElement = document.getElementById('countdown');
        if (!countdownElement) return;

        let remaining = seconds;
        
        const updateCountdown = () => {
            if (countdownElement) {
                countdownElement.textContent = remaining;
                
                if (remaining <= 10) {
                    countdownElement.className = 'font-bold text-red-600 animate-pulse';
                }
            }
            
            remaining--;
            
            if (remaining < 0) {
                this.logout('Tiempo agotado');
            }
        };

        updateCountdown();
        this.warningTimeoutId = setInterval(updateCountdown, 1000);
    }

    hideWarningModal() {
        const modal = document.getElementById('session-warning-modal');
        if (modal) {
            modal.remove();
        }
        
        if (this.warningTimeoutId) {
            clearInterval(this.warningTimeoutId);
            this.warningTimeoutId = null;
        }
    }

    async extendSession() {
        try {
            const response = await fetch('/session/extend', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });

            const data = await response.json();
            
            if (data.success) {
                this.resetTimer();
                this.showNotification('✅ Sesión extendida exitosamente', 'success');
            } else {
                this.logout('Error al extender la sesión');
            }
        } catch (error) {
            console.error('Error extending session:', error);
            this.logout('Error de conexión');
        }
    }

    async logout(reason) {
        console.log('Logging out:', reason);
        
        // Clear timers
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
        this.hideWarningModal();

        try {
            await fetch('/session/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });
        } catch (error) {
            console.error('Error during logout:', error);
        }

        // Redirect to login
        window.location.href = '/login?message=' + encodeURIComponent(reason);
    }

    showNotification(message, type = 'info') {
        // Remove existing notification
        const existing = document.getElementById('session-notification');
        if (existing) {
            existing.remove();
        }

        const notification = document.createElement('div');
        notification.id = 'session-notification';
        notification.className = `fixed top-4 right-4 p-4 rounded-md shadow-lg z-50 ${
            type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' :
            type === 'error' ? 'bg-red-100 text-red-800 border border-red-200' :
            'bg-blue-100 text-blue-800 border border-blue-200'
        }`;
        
        notification.innerHTML = `
            <div class="flex items-center">
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        `;

        document.body.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }

    destroy() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
        this.hideWarningModal();
    }
}

// Initialize session timer when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize if user is authenticated
    if (document.querySelector('meta[name="user-authenticated"]')) {
        window.sessionTimer = new SessionTimer({
            sessionTimeout: 15 * 60 * 1000, // 15 minutes
            warningTime: 2 * 60 * 1000,     // 2 minutes warning
            checkInterval: 30 * 1000        // Check every 30 seconds
        });
    }
});
