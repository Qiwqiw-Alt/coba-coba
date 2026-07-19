package com.example.my_todo.feature.todo.viewmodel

import android.content.Context
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.example.my_todo.feature.todo.repository.TodoRepository
import com.example.my_todo.model.Task
import dagger.hilt.android.lifecycle.HiltViewModel
import dagger.hilt.android.qualifiers.ApplicationContext
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.launch
import javax.inject.Inject

sealed interface TodoUiState {
    object Loading : TodoUiState
    data class Success(val tasks: List<Task>) : TodoUiState
    data class Error(val message: String) : TodoUiState
}

@HiltViewModel
class TodoViewModel @Inject constructor(
    @ApplicationContext private val context: Context,
    private val todoRepository: TodoRepository
) : ViewModel() {

    private val _uiState = MutableStateFlow<TodoUiState>(TodoUiState.Loading)
    val uiState = _uiState.asStateFlow()

    private val _task = MutableStateFlow<Task?>(null)
    val task = _task.asStateFlow()

    init {
        loadAllTask()
    }

    fun loadAllTask() {
        viewModelScope.launch(Dispatchers.IO) {
            try {
                val tasks = todoRepository.getAllTasks()
                _uiState.value = TodoUiState.Success(tasks)
                todoRepository.setError(null)
            } catch (e: Exception) {
                todoRepository.setError(e.localizedMessage)
                _uiState.value = TodoUiState.Error(e.localizedMessage ?: "Unknown error")
            }
        }
    }

    fun addTask(task: Task) {
        viewModelScope.launch(Dispatchers.IO) {
            try {
                todoRepository.addTask(task)
                todoRepository.setError(null)
                loadAllTask()
            } catch (e: Exception) {
                todoRepository.setError(e.localizedMessage)
                _uiState.value = TodoUiState.Error(e.localizedMessage ?: "Unknown error")
            }
        }
    }

    fun updateTask(task: Task) {
        viewModelScope.launch(Dispatchers.IO) {
            try {
                todoRepository.updateTask(task)
                todoRepository.setError(null)
                loadAllTask()
            } catch (e: Exception) {
                todoRepository.setError(e.localizedMessage)
                _uiState.value = TodoUiState.Error(e.localizedMessage ?: "Unknown error")
            }
        }
    }

    fun getTaskById(id: String) {
        viewModelScope.launch(Dispatchers.IO) {
            try {
                _task.value = todoRepository.getTaskById(id)
                todoRepository.setError(null)
            } catch (e: Exception) {
                todoRepository.setError(e.localizedMessage)
                _uiState.value = TodoUiState.Error(e.localizedMessage ?: "Unknown error")
            }
        }
    }

    fun deleteTask(task: Task) {
        viewModelScope.launch(Dispatchers.IO) {
            try {
                todoRepository.deleteTask(task)
                todoRepository.setError(null)
                loadAllTask()
            } catch (e: Exception) {
                todoRepository.setError(e.localizedMessage)
                _uiState.value = TodoUiState.Error(e.localizedMessage ?: "Unknown error")
            }
        }
    }

    fun deleteAllTasks() {
        viewModelScope.launch(Dispatchers.IO) {
            try {
                todoRepository.deleteAllTasks()
                todoRepository.setError(null)
                loadAllTask()
            } catch (e: Exception) {
                todoRepository.setError(e.localizedMessage)
                _uiState.value = TodoUiState.Error(e.localizedMessage ?: "Unknown error")
            }
        }
    }
}