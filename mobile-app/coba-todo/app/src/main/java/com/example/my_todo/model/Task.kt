package com.example.my_todo.model

import androidx.room.Entity
import androidx.room.PrimaryKey

@Entity(tableName = "tasks")
data class Task(
    @PrimaryKey val id: String,
    val taskName: String,
    val taskDescription: String,
    val taskStatus: Boolean,
    val created_at: String,
)
