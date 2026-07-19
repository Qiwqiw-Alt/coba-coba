package com.example.my_todo.feature.todo.repository

import androidx.room.Insert
import androidx.room.OnConflictStrategy
import androidx.room.Update
import androidx.room.Delete
import androidx.room.Query
import com.example.my_todo.model.Task

interface TodoDao {
    @Insert(onConflict = OnConflictStrategy.REPLACE)
    suspend fun insertask(task: Task)
    @Update
    suspend fun updateTask(task: Task)
    @Delete
    suspend fun deleteTask(task: Task)
    @Query("SELECT * FROM tasks")
    suspend fun getAllTasks(): List<Task>
    @Query("DELETE FROM tasks")
    suspend fun deleteAllTasks()
    @Query("SELECT * FROM tasks WHERE id =:id")
    suspend fun getTaskById(id: String): Task?
}