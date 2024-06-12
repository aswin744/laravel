<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <script>
        async function submitForm(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const userId = document.getElementById('userId').value;
            const response = await fetch(`/api/users/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            const result = await response.json();
            alert(result.message);
        }

        async function fetchUser(userId) {
            const response = await fetch(`/api/users/${userId}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            const user = await response.json();
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('city').value = user.city;
            document.getElementById('mobile').value = user.mobile;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const userId = new URLSearchParams(window.location.search).get('id');
            document.getElementById('userId').value = userId;
            fetchUser(userId);
        });
    </script>
</head>
<body>
    <h1>Update User</h1>
    <form onsubmit="submitForm(event)">
        <input type="hidden" id="userId" name="id">
        <label>Name: <input type="text" id="name" name="name" required></label><br>
        <label>Email: <input type="email" id="email" name="email" required></label><br>
        <label>City: <input type="text" id="city" name="city" required></label><br>
        <label>Mobile: <input type="text" id="mobile" name="mobile" required></label><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
