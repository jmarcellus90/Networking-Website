var lastShownTask = "contenttask0";

showTaskInbox(lastShownTask);

function showTaskInbox() {
	var taskInbox = document.getElementById("task_inbox");
	var taskSent = document.getElementById("task_sent");
	taskSent.classList.add("task-hide");
	taskInbox.classList.remove("task-hide");
}

function showTaskSent() {
	var taskInbox = document.getElementById("task_inbox");
	var taskSent = document.getElementById("task_sent");
	taskInbox.classList.add("task-hide");
	taskSent.classList.remove("task-hide");
}
