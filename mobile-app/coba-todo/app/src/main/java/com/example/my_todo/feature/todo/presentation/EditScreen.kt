package com.example.my_todo.feature.todo.presentation

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.automirrored.filled.ArrowBack
import androidx.compose.material3.Button
import androidx.compose.material3.DropdownMenuItem
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.ExposedDropdownMenuBox
import androidx.compose.material3.ExposedDropdownMenuDefaults
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.OutlinedTextField
import androidx.compose.material3.Scaffold
import androidx.compose.material3.Text
import androidx.compose.material3.TopAppBar
import androidx.compose.runtime.Composable
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Modifier
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import com.example.my_todo.feature.todo.viewmodel.TodoViewModel
import com.example.my_todo.model.Task

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun EditContent(
    currentTask: Task? = null,
    onSaveTask: (String, String, Boolean) -> Unit,
    onNavigateToDetail: (String) -> Unit,
    onBack: () -> Unit,
){
    var taskName by remember { mutableStateOf(currentTask?.taskName ?: "") }
    var taskDescription by remember { mutableStateOf(currentTask?.taskDescription ?: "") }
    var taskStatus by remember { mutableStateOf(currentTask?.taskStatus ?: false) }

    var categories = listOf("Completed", "Incompleted")
    var expanded by remember { mutableStateOf(false) }

    LaunchedEffect(currentTask) {
        currentTask?.let { task ->
            taskName = task.taskName
            taskDescription = task.taskDescription
            taskStatus = task.taskStatus
        }
    }

    Scaffold(
        topBar = {
            TopAppBar(
                title = { Text("Edit Task ")},
                navigationIcon = {
                    IconButton(onClick = onBack) {
                        Icon(
                            imageVector = Icons.AutoMirrored.Filled.ArrowBack,
                            contentDescription = "Back"
                        )
                    }
                }
            )
        }
    ) { paddingValues ->
        Column(
            modifier = Modifier
                .fillMaxSize()
                .padding(paddingValues)
                .padding(16.dp),
            verticalArrangement = Arrangement.spacedBy(16.dp)
        ) {
            OutlinedTextField(
                value = taskName,
                onValueChange = { taskName = it},
                label = { Text("Task Name")},
                modifier = Modifier.fillMaxWidth(),
                singleLine = true
            )

            OutlinedTextField(
                value = taskDescription,
                onValueChange = { taskDescription = it},
                label = { Text("Task Description")},
                modifier = Modifier.fillMaxWidth(),
                minLines = 3
            )

            ExposedDropdownMenuBox(
                expanded = expanded,
                onExpandedChange = { expanded = !expanded }
            ) {
                OutlinedTextField(
                    value = if (taskStatus) "Completed" else "Incompleted",
                    onValueChange = {},
                    readOnly = true,
                    label = { Text("Task Status")},
                    trailingIcon = {
                        ExposedDropdownMenuDefaults.TrailingIcon(expanded = expanded)
                    },
                    colors = ExposedDropdownMenuDefaults.textFieldColors(),
                    modifier = Modifier.fillMaxWidth().menuAnchor()
                )

                ExposedDropdownMenu(
                    expanded = expanded,
                    onDismissRequest = { expanded = false }
                ) {
                    categories.forEach { category ->
                        DropdownMenuItem(
                            text = { Text(category)},
                            onClick = {
                                taskStatus = (category == "Completed")
                                expanded = false
                            }
                        )
                    }
                }
            }


            Row() {
                Button(
                    onClick = {
                        if (taskName.isNotBlank()) {
                            onSaveTask(taskName, taskDescription, taskStatus)
                        }
                    },
                    modifier = Modifier.weight(1f),
                    enabled = taskName.isNotBlank()
                ) {
                    Text("Save Task")
                }

                Button(
                    onClick = { onNavigateToDetail(currentTask?.id ?: "")},
                    modifier = Modifier.weight(1f),
                    enabled = true
                ) {
                    Text("Task Detail")
                }
            }

        }

    }
}

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun EditScreen(
    viewModel: TodoViewModel = hiltViewModel(),
    currentIdTask: String,
    onNavigateToDetail: (String) -> Unit,
    onBack: () -> Unit,
){
    LaunchedEffect(currentIdTask) {
        viewModel.getTaskById(currentIdTask)
    }

    val currentTask by viewModel.task.collectAsStateWithLifecycle()

    currentTask?.let { task ->
        EditContent(
            currentTask = task,
            onSaveTask = { taskName, taskDescription, taskStatus ->
                val editedTask = Task(
                    id = currentIdTask,
                    taskName = taskName,
                    taskDescription = taskDescription,
                    taskStatus = taskStatus,
                    created_at = task.created_at
                )
                viewModel.updateTask(editedTask)
                onBack()
            },
            onBack = onBack,
            onNavigateToDetail = onNavigateToDetail
        )
    }
}