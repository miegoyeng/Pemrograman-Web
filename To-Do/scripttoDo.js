
const todoInput = document.getElementById('todoInput');
const addBtn = document.getElementById('addBtn');
const todoList = document.getElementById('todoList');

function addTask() {
    const taskText = todoInput.value;

    if (taskText === '') {
        alert('Please enter a task!');
        return;
    }

    const li = document.createElement('li');
    const span = document.createElement('span');
    span.textContent = taskText;
    li.appendChild(span);

    const editBtn = document.createElement('button');
    editBtn.textContent = 'Edit';
    editBtn.classList.add('editBtn');
    editBtn.onclick = function () {
        const newTaskText = prompt('Edit your task:', span.textContent);
        if (newTaskText !== null && newTaskText !== '') {
            span.textContent = newTaskText;
        }
    };

    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Delete';
    deleteBtn.classList.add('deleteBtn');
    deleteBtn.onclick = function () {
        todoList.removeChild(li); 
    };

    // Tambahkan tombol edit dan delete ke dalam li
    li.appendChild(editBtn);
    li.appendChild(deleteBtn);

    todoList.appendChild(li);

    todoInput.value = '';
}
addBtn.addEventListener('click', addTask);

todoInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        addTask();
    }
});
