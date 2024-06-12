<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>
    <script>
        async function fetchUsers(page = 1) {
            const response = await fetch(`/api/users?page=${page}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            const data = await response.json();
            const usersTable = document.getElementById('usersTable').getElementsByTagName('tbody')[0];
            usersTable.innerHTML = '';
            data.data.forEach(user => {
                const row = usersTable.insertRow();
                row.insertCell(0).innerText = user.name;
                row.insertCell(1).innerText = user.email;
                row.insertCell(2).innerText = user.city;
                row.insertCell(3).innerText = user.mobile;
                const actionsCell = row.insertCell(4);
                actionsCell.innerHTML = `
                    <button onclick="updateUser(${user.id})">Update</button>
                    <button onclick="deleteUser(${user.id})">Delete</button>
                `;
            });
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                fetch(`/api/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    fetchUsers(); // Refresh the user list
                });
            }
        }

        function updateUser(userId) {
            window.location.href = `/users/${userId}/edit`;
        }

        document.addEventListener('DOMContentLoaded', () => fetchUsers());
    </script>
</head>
<body>
    <h1>Display Users</h1>
    <table id="usersTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <button onclick="fetchUsers()">Next Page</button>
</body>
</html>
