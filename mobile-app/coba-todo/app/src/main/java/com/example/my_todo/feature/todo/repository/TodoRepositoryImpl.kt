package com.example.my_todo.feature.todo.repository

import com.example.my_todo.model.Task

class TodoRepositoryImpl (
    private val todoDao: TodoDao
): TodoRepository  {
    private var errorMessage: String? = null

    override suspend fun addTask(task: Task) {
        try {
            todoDao.insertask(task)
            errorMessage = null
        } catch (e: Exception) {
            errorMessage = e.localizedMessage
        }
    }

    override suspend fun updateTask(task: Task) {
        try {
            todoDao.updateTask(task)
            errorMessage = null
        } catch (e: Exception) {
            errorMessage = e.localizedMessage
        }
    }

    override suspend fun deleteTask(task: Task) {
        try {
            todoDao.deleteTask(task)
            errorMessage = null
        } catch (e: Exception) {
            errorMessage = e.localizedMessage
        }
    }

    override suspend fun getAllTasks(): List<Task> {
        return try {
            errorMessage = null
            todoDao.getAllTasks()
        } catch (e: Exception) {
            errorMessage = e.localizedMessage
            emptyList()
        }
    }

    override suspend fun deleteAllTasks() {
        try {
            todoDao.deleteAllTasks()

            errorMessage = null
        } catch (e: Exception) {
            errorMessage = e.localizedMessage
        }
    }

    override suspend fun getTaskById(id: String): Task? {
        return try {
            errorMessage = null
            todoDao.getTaskById(id)
        } catch (e: Exception) {
            errorMessage = e.localizedMessage
            null
        }
    }

    override suspend fun getError(): String? {
        return errorMessage
    }
}