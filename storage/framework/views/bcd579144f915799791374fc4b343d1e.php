<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <style>
        /* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Button Styles */
button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background-color: #45a049;
}

a {
    background-color: #008CBA; /* Blue */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}

a:hover {
    background-color: #005F6B;
}

    </style>
</head>
<body>
    <h1>Users</h1>

    <?php if(session('success')): ?>
        <div style="color: green;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->gender); ?></td>
                    <td><?php echo e($user->mobile); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td>
                        <a href="<?php echo e(route('users.edit', $user->id)); ?>">Edit</a>
                        <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\Aditya workspace\Laravel\firstProject\resources\views/users/index.blade.php ENDPATH**/ ?>