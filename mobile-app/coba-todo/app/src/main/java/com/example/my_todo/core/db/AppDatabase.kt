package com.example.my_todo.core.db

import androidx.room.Database
import androidx.room.RoomDatabase
import com.example.my_todo.feature.todo.repository.TodoDao
import com.example.my_todo.model.Task


@Database(entities = [Task::class], version = 1, exportSchema = false)
abstract class AppDatabase : RoomDatabase() {
    abstract fun todoDao(): TodoDao
}