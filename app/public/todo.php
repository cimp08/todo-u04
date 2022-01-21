<?php require 'includes/views/header.php'; ?>
<?php require 'includes/views/navbar.php'; ?>

<main>
    <section class="add-section">
        <h1>TO DO LIST!</h1>
        <form action="includes/todos.inc.php" method="post">
            <input
            id="taskinput"
            class="add-section-input"
            type="text" 
            name="task" 
            placeholder="Enter a task"
            autocomplete="off"
            required>
            <input type="hidden" name="id">
            <button class="btn-add" name="submit_create" type="submit"><ion-icon name="add-outline"></ion-icon></button>
        </form>
    </section>
    
    
    <section class="show-section">
        <?php
        require_once 'classes/todos.contr.classes.php';
        $task = new TodosContr();
        $rows = $task->setTodos();
        ?>

        <?php if(!empty($rows->rowCount())) : ?>
        <ul>
            <?php foreach($rows as $row): ?>
                <li class="show-section-items">
                    <?php if (!$row['completed']):?>
                    <a class="btn-toggle" href="complete.php?as=notcompleted&id=<?php echo $row['id']?>"><ion-icon name="checkmark-outline"></ion-icon></a>
                    <?php else: ?>
                    <a class="btn-toggle" href="complete.php?as=completed&id=<?php echo $row['id']?>"><ion-icon name="checkmark-outline"></ion-icon></a>
                    <?php endif;?>
                    <h2 class="task<?php echo $row['completed'] ? ' completed' : '' ?>"><?php echo $row['task'];?></h2>
                    <a class="btn-edit" href="index.php?edit=<?php echo $row['id']?>"><ion-icon name="create-outline"></ion-icon></a>
                    <a class="btn-del" href="delete.php?delete=<?php echo $row['id']?>" onclick="return checkDelete()"><ion-icon name="close-outline"></ion-icon></a> 
                    <p class="created">Created by <?php echo $row['users_username']?> on <?php echo $row['created']?></p>
                </li> 
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <div class="show-section-items center">
            <ion-icon class="calendar" name="calendar-clear-outline"></ion-icon>
            <p class="notask">No tasks added </p>
            <a class="add-link" href="#taskinput">Add a task <span class="add-plus">+</span></a>
        </div>
        <?php endif;?>
    </section>
</main>
<?php require 'includes/views/footer.php'; ?> 