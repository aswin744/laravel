<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <script>
        async function submitForm(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const response = await fetch('/api/users', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            const result = await response.json();
            alert(result.message);
        }
    </script>
</head>
<body>
    <h1>Create User</h1>
    <form onsubmit="submitForm(event)">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>City: <input type="text" name="city" required></label><br>
        <label>Mobile: <input type="text" name="mobile" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
