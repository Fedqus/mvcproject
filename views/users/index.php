<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Age</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
                <tr>
                    <th scope="row"><?= $user["id"] ?></th>
                    <td><?= $user["login"] ?></td>
                    <td><?= $user["password"] ?></td>
                    <td><?= $user["age"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>