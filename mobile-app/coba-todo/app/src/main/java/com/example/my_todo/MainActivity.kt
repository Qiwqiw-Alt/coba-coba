package com.example.my_todo

import android.os.Bundle
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.activity.enableEdgeToEdge
import androidx.lifecycle.lifecycleScope
import com.example.my_todo.core.route.AppNavigation
import com.example.my_todo.ui.theme.My_todoTheme
import androidx.core.splashscreen.SplashScreen.Companion.installSplashScreen
import dagger.hilt.android.AndroidEntryPoint
import kotlinx.coroutines.delay
import kotlinx.coroutines.launch

@AndroidEntryPoint
class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        val splashScreen = installSplashScreen()

        var keepSplashScreen = true
        splashScreen.setKeepOnScreenCondition { keepSplashScreen }

        lifecycleScope.launch {
            delay(1500)
            keepSplashScreen = false
        }

        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContent {
            My_todoTheme {
                AppNavigation()
            }
        }
    }
}