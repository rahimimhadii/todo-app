<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
</head>
<body>

<h1>Todo List</h1>

<button type="button" id="addTodo">+</button>

<div id="todoList">

    @foreach ($todos as $todo)
        <div data-id="{{ $todo->id }}">
            <input type="text" value="{{ $todo->title }}">
            <input type="checkbox" {{ $todo->completed ? 'checked' : '' }}>
            <button type="button" class="deleteTodo">🗑</button>
        </div>
    @endforeach


</div>
<button type="button" id="saveTodos">Save</button>
<script>
    document.querySelectorAll('.deleteTodo').forEach(function (deleteButton) {

        deleteButton.addEventListener('click', function () {
            deleteButton.parentElement.remove();
        });

    });
    const addTodoButton = document.getElementById('addTodo');
    const todoList = document.getElementById('todoList');

    addTodoButton.addEventListener('click', function () {

        const todoRow = document.createElement('div');

        todoRow.innerHTML = `
            <input type="text" placeholder="عنوان Todo">
            <input type="checkbox">
            <button type="button" class="deleteTodo">🗑</button>
        `;

        todoList.appendChild(todoRow);

        const deleteButton = todoRow.querySelector('.deleteTodo');

        deleteButton.addEventListener('click', function () {
            todoRow.remove();
        });
    });

    const saveTodosButton = document.getElementById('saveTodos');

    saveTodosButton.addEventListener('click', function () {

        const rows = document.querySelectorAll('#todoList > div');

        const todos = [];

        rows.forEach(function (row) {

            const id = row.dataset.id;
            const title = row.querySelector('input[type="text"]').value;
            const completed = row.querySelector('input[type="checkbox"]').checked;

            todos.push({
                id: id,
                title: title,
                completed: completed
            });

        });

        console.log(todos);
        alert('Save clicked');
        fetch('/todos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                todos: todos
            })
        })
            .then(response => response.text())
            .then(data => {
                alert(data);
            });
    });
</script>
</body>
</html>
