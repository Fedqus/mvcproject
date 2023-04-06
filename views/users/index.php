<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key => $user) : ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $user["name"] ?></td>
                    <td><?= $user["lastname"] ?></td>
                    <td><?= $user["email"] ?></td>
                    <td><?= $user["birth_date"] ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/users/edit/<?=$user["email"]?>">Edit</a></li>
                                <li><a class="dropdown-item" href="/users/delete/<?=$user["email"]?>">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>