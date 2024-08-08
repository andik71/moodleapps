<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>All Courses</title>
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
        <h1>All Courses</h1>
        <table class="table table-striped" id="courses-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Short Name</th>
                    <th>Category ID</th>
                    <th>Summary</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        $(document).ready(function() {
            $.get('../apihandler/api.php?action=get_courses', function(data) {
                const courses = JSON.parse(data);
                const tbody = $('#courses-table tbody');
                tbody.empty();
                if (Array.isArray(courses)) {
                    courses.forEach(course => {
                        const row = `<tr>
                            <td>${course.id}</td>
                            <td>${course.fullname}</td>
                            <td>${course.shortname}</td>
                            <td>${course.categoryid}</td>
                            <td>${course.summary}</td>
                        </tr>`;
                        tbody.append(row);
                    });
                } else {
                    tbody.append('<tr><td colspan="5">No courses found.</td></tr>');
                }
            });
        });
    </script>
</body>

</html>