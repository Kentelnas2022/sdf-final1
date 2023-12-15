<?php
class TaskUpdater {
    private $conn;

    public function __construct() {
        include 'dbcon.php'; // Include your database connection
        $this->conn = $conn;
    }

    public function renderUpdateForm($id) {
        $sql = "SELECT * FROM tb_add WHERE id=" . $id;
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['add_task'];
        }
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>| Welcome |</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        </head>
        <body>
            <h1 class="text-center py-4 my-4">Update Your List</h1>
            <div class="w-50 m-auto">
                <form action="user_dashboard_editaction.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Edit Here Your ToDo'S" required>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    </div><br>
                    <button class="btn btn-success" name="updateTask">Update ToDo'S</button>
                </form>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
                crossorigin="anonymous"></script>
        </body>
        </html>
        <?php
    }
}

// Usage
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $taskUpdater = new TaskUpdater();
    $taskUpdater->renderUpdateForm($id);
}
?>
