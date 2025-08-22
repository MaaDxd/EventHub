/**
 * Password Toggle Functionality
 * Adds show/hide password functionality to password inputs
 */

class PasswordToggle {
    constructor() {
        this.init();
    }

    init() {
        // Initialize all password fields on page load
        document.addEventListener('DOMContentLoaded', () => {
            this.setupPasswordFields();
        });
    }

    setupPasswordFields() {
        // Find all password inputs that don't already have toggle functionality
        const passwordInputs = document.querySelectorAll('input[type="password"]:not([data-password-toggle])');
        
        passwordInputs.forEach(input => {
            this.addToggleToField(input);
        });
    }

    addToggleToField(input) {
        // Mark this input as processed
        input.setAttribute('data-password-toggle', 'true');
        
        // Create wrapper div if it doesn't exist
        let wrapper = input.parentElement;
        if (!wrapper.classList.contains('password-field-wrapper')) {
            wrapper = document.createElement('div');
            wrapper.className = 'password-field-wrapper relative';
            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);
        }

        // Add relative positioning to input
        input.classList.add('pr-12');

        // Create toggle button
        const toggleButton = document.createElement('button');
        toggleButton.type = 'button';
        toggleButton.className = 'absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 transition-colors duration-200';
        toggleButton.setAttribute('aria-label', 'Mostrar contraseña');
        
        // Create eye icon (hidden state)
        const eyeIcon = this.createEyeIcon();
        const eyeSlashIcon = this.createEyeSlashIcon();
        
        // Initially show the eye icon (password hidden)
        toggleButton.appendChild(eyeIcon);
        
        // Add click event
        toggleButton.addEventListener('click', (e) => {
            e.preventDefault();
            this.togglePassword(input, toggleButton, eyeIcon, eyeSlashIcon);
        });

        // Add to wrapper
        wrapper.appendChild(toggleButton);
    }

    togglePassword(input, button, eyeIcon, eyeSlashIcon) {
        const isPassword = input.type === 'password';
        
        if (isPassword) {
            // Show password
            input.type = 'text';
            button.innerHTML = '';
            button.appendChild(eyeSlashIcon);
            button.setAttribute('aria-label', 'Ocultar contraseña');
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                if (input.type === 'text') {
                    this.hidePassword(input, button, eyeIcon);
                }
            }, 3000);
        } else {
            // Hide password
            this.hidePassword(input, button, eyeIcon);
        }
    }

    hidePassword(input, button, eyeIcon) {
        input.type = 'password';
        button.innerHTML = '';
        button.appendChild(eyeIcon);
        button.setAttribute('aria-label', 'Mostrar contraseña');
    }

    createEyeIcon() {
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('class', 'w-5 h-5');
        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', 'currentColor');
        svg.setAttribute('viewBox', '0 0 24 24');
        
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('stroke-linecap', 'round');
        path.setAttribute('stroke-linejoin', 'round');
        path.setAttribute('stroke-width', '2');
        path.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z');
        
        const path2 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path2.setAttribute('stroke-linecap', 'round');
        path2.setAttribute('stroke-linejoin', 'round');
        path2.setAttribute('stroke-width', '2');
        path2.setAttribute('d', 'M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
        
        svg.appendChild(path);
        svg.appendChild(path2);
        
        return svg;
    }

    createEyeSlashIcon() {
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('class', 'w-5 h-5');
        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', 'currentColor');
        svg.setAttribute('viewBox', '0 0 24 24');
        
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('stroke-linecap', 'round');
        path.setAttribute('stroke-linejoin', 'round');
        path.setAttribute('stroke-width', '2');
        path.setAttribute('d', 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21');
        
        svg.appendChild(path);
        
        return svg;
    }

    // Method to manually add toggle to a specific field (useful for dynamically created fields)
    addToggleToSpecificField(fieldId) {
        const input = document.getElementById(fieldId);
        if (input && input.type === 'password' && !input.hasAttribute('data-password-toggle')) {
            this.addToggleToField(input);
        }
    }

    // Method to refresh all password fields (useful after AJAX content loads)
    refresh() {
        this.setupPasswordFields();
    }
}

// Initialize password toggle functionality
window.passwordToggle = new PasswordToggle();

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PasswordToggle;
}
