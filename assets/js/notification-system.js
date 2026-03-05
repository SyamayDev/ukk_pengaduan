/**
 * Notification System
 * Sistem notifikasi untuk admin panel dengan animasi slide dari kanan
 */

(function () {
  // Create notification container if doesn't exist
  let container = document.getElementById('notificationContainer');
  if (!container) {
    container = document.createElement('div');
    container.id = 'notificationContainer';
    container.style.position = 'fixed';
    container.style.bottom = '20px';
    container.style.right = '20px';
    container.style.zIndex = '9999';
    container.style.maxWidth = '350px';
    document.body.appendChild(container);
  }

  window.showNotification = function (
    title,
    message,
    type = 'info',
    duration = 3000,
    actionCallback = null,
  ) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;

    let icon = '📋';
    if (type === 'success') icon = '✓';
    else if (type === 'warning') icon = '⚠';
    else if (type === 'danger') icon = '✕';
    else if (type === 'info') icon = 'ℹ';

    notification.innerHTML = `
            <span class="notification-close" onclick="this.closest('.notification').remove();">×</span>
            <div class="notification-icon">${icon}</div>
            <div class="notification-content">
                <div class="notification-title">${title}</div>
                <div class="notification-message">${message}</div>
            </div>
            <div style="clear: both;"></div>
        `;

    if (actionCallback) {
      notification.style.cursor = 'pointer';
      notification.onclick = (e) => {
        if (!e.target.classList.contains('notification-close')) {
          actionCallback();
          notification.remove();
        }
      };
    }

    container.appendChild(notification);

    if (duration > 0) {
      setTimeout(() => {
        if (notification.parentElement) {
          notification.style.animation = 'slideOut 0.4s ease-out forwards';
          setTimeout(() => notification.remove(), 400);
        }
      }, duration);
    }
  };

  // Add styles if not already added
  if (!document.getElementById('notificationStyles')) {
    const style = document.createElement('style');
    style.id = 'notificationStyles';
    style.textContent = `
            #notificationContainer {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 9999;
                max-width: 350px;
            }

            .notification {
                background: white;
                border-left: 4px solid #3B82F6;
                padding: 16px;
                margin-bottom: 12px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                animation: slideIn 0.4s ease-out;
                cursor: pointer;
                transition: all 0.3s ease;
                overflow: hidden;
            }

            .notification:hover {
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
                transform: translateX(-5px);
            }

            .notification.info {
                border-left-color: #3B82F6;
            }

            .notification.success {
                border-left-color: #10B981;
            }

            .notification.warning {
                border-left-color: #F59E0B;
            }

            .notification.danger {
                border-left-color: #EF4444;
            }

            .notification-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin-right: 12px;
                font-size: 20px;
                float: left;
                flex-shrink: 0;
            }

            .notification.info .notification-icon {
                background-color: #DDE9F9;
                color: #3B82F6;
            }

            .notification.success .notification-icon {
                background-color: #D2F5E9;
                color: #10B981;
            }

            .notification.warning .notification-icon {
                background-color: #FEF3C7;
                color: #F59E0B;
            }

            .notification.danger .notification-icon {
                background-color: #FEE2E2;
                color: #EF4444;
            }

            .notification-content {
                overflow: hidden;
            }

            .notification-title {
                font-weight: bold;
                color: #1F2937;
                margin-bottom: 4px;
                font-size: 14px;
            }

            .notification-message {
                color: #6B7280;
                font-size: 13px;
                line-height: 1.4;
            }

            .notification-close {
                float: right;
                cursor: pointer;
                color: #9CA3AF;
                font-size: 20px;
                line-height: 1;
                transition: color 0.2s ease;
                margin-left: 10px;
            }

            .notification-close:hover {
                color: #374151;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(400px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes slideOut {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(400px);
                }
            }
        `;
    document.head.appendChild(style);
  }
})();
