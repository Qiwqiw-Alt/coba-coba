package com.example.my_todo.feature.todo.presentation

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.automirrored.filled.ArrowBack
import androidx.compose.material3.Button
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.Scaffold
import androidx.compose.material3.Text
import androidx.compose.material3.TopAppBar
import androidx.compose.runtime.Composable
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.runtime.getValue
import androidx.compose.ui.Modifier
import androidx.compose.ui.tooling.preview.Preview
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import com.example.my_todo.feature.todo.viewmodel.TodoViewModel
import com.example.my_todo.model.Task

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun DetailContent(
    currentTask: Task? = null,
    onNavigateToEdit: (String) -> Unit,
    onBack: () -> Unit,
) {

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
            Text(
                text = "Task Name: ${currentTask?.taskName ?: ""}",
                modifier = Modifier.fillMaxWidth()
            )

            Spacer(modifier = Modifier.height(8.dp))

            Text(
                text = "Task Description: ${currentTask?.taskDescription ?: ""}",
                modifier = Modifier.fillMaxWidth()
            )

            Spacer(modifier = Modifier.height(8.dp))


            Text(
                text = "Task Status: ${if (currentTask?.taskStatus == true) "Completed" else "Incompleted"}",
                modifier = Modifier.fillMaxWidth()
            )

            Spacer(modifier = Modifier.height(8.dp))

            Button(
                onClick = { onNavigateToEdit(currentTask?.id ?: "") },
                modifier = Modifier.weight(1f),
                enabled = true
            ) {
                Text("Task Detail")
            }

        }
    }
}

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun DetailScreen(
    viewModel: TodoViewModel = hiltViewModel(),
    currentIdTask: String,
    onBack: () -> Unit,
    onNavigateToEdit: (String) -> Unit
){
    LaunchedEffect(currentIdTask) {
        viewModel.getTaskById(currentIdTask)
    }

    val currentTask by viewModel.task.collectAsStateWithLifecycle()

    currentTask?.let { task ->
        DetailContent(
            currentTask = task,
            onNavigateToEdit = onNavigateToEdit,
            onBack = onBack,
        )
    }
}

@Preview(showSystemUi = true)
@Composable
fun DetailPreview() {
    DetailContent(
        onBack = {},
        onNavigateToEdit = {_, ->}
    )
}