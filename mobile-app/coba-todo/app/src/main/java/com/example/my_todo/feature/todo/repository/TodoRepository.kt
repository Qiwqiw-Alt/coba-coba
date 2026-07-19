package com.example.my_todo.feature.todo.repository

import com.example.my_todo.model.Task

interface TodoRepository {
    suspend fun addTask(task: Task)
    suspend fun updateTask(task: Task)
    suspend fun deleteTask(task: Task)
    suspend fun getAllTasks(): List<Task>
    suspend fun deleteAllTasks()
    suspend fun getTaskById(id: String): Task?
    suspend fun getError(): String?
}