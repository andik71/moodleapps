<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Create User</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Moodle LMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="getuserall.php">View Users</a></li>
                <li class="nav-item"><a class="nav-link" href="getcourseall.php">View Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="getcategoryall.php">View Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="createuser.php">Create User</a></li>
                <li class="nav-item"><a class="nav-link" href="createcourse.php">Create Course</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>Create User</h1>
        <form id="create-user-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#create-user-form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '../apihandler/api.php?action=create_user',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        try {
                            const res = JSON.parse(response);
                            if (res.error) {
                                alert('Error: ' + res.error);
                            } else {
                                alert('User created successfully!');
                                window.location.href = 'getuserall.php';
                            }
                        } catch (e) {
                            alert('Unexpected response format.');
                        }
                    },
                    error: function () {
                        alert('Failed to create user.');
                    }
                });
            });
        });
    </script>
</body>

</html>
