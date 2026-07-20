package com.example.my_todo.core.route

import androidx.compose.runtime.Composable
import androidx.navigation.compose.NavHost
import androidx.navigation.compose.composable
import androidx.navigation.compose.rememberNavController
import androidx.navigation.toRoute
import com.example.my_todo.feature.todo.presentation.AddScreen
import com.example.my_todo.feature.todo.presentation.EditScreen
import com.example.my_todo.feature.todo.presentation.DetailScreen
import com.example.my_todo.feature.todo.presentation.HomepageScreen

@Composable
fun AppNavigation() {
    val navController = rememberNavController()

    NavHost(
        navController = navController,
        startDestination = HomeRoute
    ) {
        composable<HomeRoute> {
            HomepageScreen(
                onNavigateToAdd = {
                    navController.navigate(AddRoute)
                },
                onNavigateToDetail = { taskId ->
                    navController.navigate(DetailRoute(taskId))
                },
                onNavigateToEdit = { taskId ->
                    navController.navigate((EditRoute(taskId)))
                }
            )
        }

        composable<AddRoute> {
            AddScreen(onBack = { navController.popBackStack() } )
        }

        composable<EditRoute> { backStackEntry ->
            val route = backStackEntry.toRoute<EditRoute>()

            EditScreen(
                currentIdTask = route.taskId,
                onBack = { navController.popBackStack() },
                onNavigateToDetail = { taskId -> navController.navigate(DetailRoute(taskId))}
            )
        }

        composable<DetailRoute> { backStackEntry ->
            val route = backStackEntry.toRoute<DetailRoute>()

            DetailScreen(
                currentIdTask = route.taskId,
                onBack = { navController.popBackStack() },
                onNavigateToEdit = { taskId -> navController.navigate(EditRoute(taskId))}
            )
        }
    }
}