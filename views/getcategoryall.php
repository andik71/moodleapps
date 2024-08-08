<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>All Categories</title>
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
        <h1>All Categories</h1>
        <table class="table table-striped" id="categories-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>ID Number</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        $(document).ready(function() {
            $.get('../apihandler/api.php?action=get_categories', function(data) {
                const categories = JSON.parse(data);
                const tbody = $('#categories-table tbody');
                tbody.empty();
                if (Array.isArray(categories)) {
                    categories.forEach(category => {
                        const row = `<tr>
                            <td>${category.id}</td>
                            <td>${category.name}</td>
                            <td>${category.idnumber}</td>
                            <td>${category.description}</td>
                        </tr>`;
                        tbody.append(row);
                    });
                } else {
                    tbody.append('<tr><td colspan="4">No categories found.</td></tr>');
                }
            });
        });
    </script>
</body>

</html>