document.addEventListener('DOMContentLoaded', (event) => {
    const themeToggle = document.getElementById('themeToggle');
    const navbar = document.querySelector('.navbar');
    const currentTheme = localStorage.getItem('theme');

    function updateNavbarClass(isDarkMode) {
        if (isDarkMode) {
            navbar.classList.remove('bg-light');
        } else {
            navbar.classList.add('bg-light');
        }
    }

    if (currentTheme === 'dark') {
        document.body.classList.add('dark-mode');
        updateNavbarClass(true);
        themeToggle.textContent = 'Light theme';
    } else {
        updateNavbarClass(false);
    }

    themeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        let theme = 'light';
        if (document.body.classList.contains('dark-mode')) {
            theme = 'dark';
            themeToggle.textContent = 'Light theme';
            updateNavbarClass(true);
        } else {
            themeToggle.textContent = 'Dark theme';
            updateNavbarClass(false);
        }
        localStorage.setItem('theme', theme);
    });
});

function deleteUser(userId) {
    if (confirm('Are you sure?')) {
        $.ajax({
            type: 'POST',
            url: './delete_user.php',
            data: { user_id: userId },
            success: function(response) {
                console.log('The account has been deleted:', response);
                window.location.reload();
            },
            error: function() {
                console.error('Error deleting account!');
            }
        });
    }
}

function editMessage(messageId) {
    var messageText = prompt('Edit your message:');
    if (messageText) {
        $.ajax({
            url: './edit_message.php',
            type: 'POST',
            data: { message_id: messageId, message: messageText },
            success: function(response) {
                fetchMessages();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
}

function deleteMessage(messageId) {
    if (confirm('Are you sure you want to delete this message?')) {
        $.ajax({
            url: './delete_message.php',
            type: 'POST',
            data: { message_id: messageId },
            success: function(response) {
                fetchMessages();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
}