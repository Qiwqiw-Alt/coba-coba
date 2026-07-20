package com.example.my_todo.core.route

import kotlinx.serialization.Serializable

@Serializable
object HomeRoute

@Serializable
object AddRoute

@Serializable
data class EditRoute(val taskId: String)

@Serializable
data class DetailRoute(val taskId: String)

