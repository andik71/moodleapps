<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Create Course</title>
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
        <h1>Create Course</h1>
        <form id="create-course-form">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="shortname">Short Name</label>
                <input type="text" class="form-control" id="shortname" name="shortname" required>
            </div>
            <div class="form-group">
                <label for="categoryid">Category ID</label>
                <input type="number" class="form-control" id="categoryid" name="categoryid" required>
            </div>
            <div class="form-group">
                <label for="summary">Summary</label>
                <textarea class="form-control" id="summary" name="summary" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Course</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#create-course-form').on('submit', function(e) {
                e.preventDefault();

                // Validate form data before sending request
                const fullname = $('#fullname').val().trim();
                const shortname = $('#shortname').val().trim();
                const categoryid = $('#categoryid').val().trim();
                const summary = $('#summary').val().trim();

                if (!fullname || !shortname || !categoryid || !summary) {
                    alert('All fields are required.');
                    return;
                }

                const formData = $(this).serialize();

                $.post('../apihandler/api.php?action=create_course', formData, function(response) {
                    try {
                        const res = JSON.parse(response);
                        if (res.error) {
                            alert('Error: ' + res.error);
                        } else {
                            alert('Course created successfully!');
                            window.location.href = 'getcourseall.php';
                        }
                    } catch (e) {
                        alert('Unexpected response format.');
                    }
                }).fail(function() {
                    alert('Failed to create course.');
                });
            });
        });
    </script>
</body>

</html>