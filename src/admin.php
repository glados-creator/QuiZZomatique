<?php
Commun\commun::must_login();
if (!isset($_SESSION['user']) || $_SESSION['user']->getProf() !== true) {
    die('Access denied');
}

// Fetch quizzes and users from the database
$sql = \DB\sql::getInstance();
$quizzes = $sql->getAllQuizzes();
$users = $sql->load("SELECT * FROM user");

?>


<h1>Admin Dashboard</h1>

<!-- Collapsible for Quizzes -->
<button class="collapsible">All Quizzes</button>
<div class="content">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quizzes as $quiz): ?>
                <tr>
                    <td><?php echo $quiz->getId(); ?></td>
                    <td><?php echo $quiz->getName(); ?></td>
                    <td><?php echo $quiz->getContent(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Collapsible for Users -->
<button class="collapsible">All Users</button>
<div class="content">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Prof</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['nom'] . ' ' . $user['prenom']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['prof'] ? 'Yes' : 'No'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Collapsible for Answers per Quiz -->
<?php foreach ($quizzes as $quiz): ?>
    <button class="collapsible">Answers for <?php echo $quiz->getName(); ?></button>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user):
                    $answer = $sql->getAnswers($quiz->getId());
                    if ($answer !== null):
                        ?>
                        <tr>
                            <td><?php echo $user['nom'] . ' ' . $user['prenom']; ?></td>
                            <td><?php echo $answer->getAnswer(); ?></td>
                        </tr>
                    <?php endif; endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>

<script>
    // Script to handle collapsible sections
    var coll = document.getElementsByClassName("collapsible");
    for (var i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>