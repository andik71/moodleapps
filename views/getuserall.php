<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>All Users</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Moodle LMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="getuserall.php">View Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="getcourseall.php">View Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="getcategoryall.php">View Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="createuser.php">Create User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="createcourse.php">Create Course</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>All Users</h1>
        <table class="table table-striped" id="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $.get('../apihandler/api.php?action=get_users', function(data) {
                try {
                    const response = JSON.parse(data);
                    const tbody = $('#users-table tbody');
                    tbody.empty();

                    if (Array.isArray(response.users)) {
                        response.users.forEach(user => {
                            const row = `
                                <tr>
                                    <td>${user.id}</td>
                                    <td>${user.username}</td>
                                    <td>${user.firstname}</td>
                                    <td>${user.lastname}</td>
                                    <td>${user.email}</td>
                                </tr>`;
                            tbody.append(row);
                        });

                        // Initialize DataTable after data is loaded
                        $('#users-table').DataTable();
                    } else {
                        tbody.append('<tr><td colspan="5">No users found.</td></tr>');
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    console.error("Response data:", data);
                    $('#users-table tbody').append('<tr><td colspan="5">Error loading data.</td></tr>');
                }
            }).fail(function() {
                $('#users-table tbody').append('<tr><td colspan="5">Failed to load users.</td></tr>');
            });
        });
    </script>
</body>

</html>
