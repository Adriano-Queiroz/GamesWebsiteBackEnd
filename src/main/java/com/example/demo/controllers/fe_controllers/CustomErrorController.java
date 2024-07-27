package com.example.demo.controllers.fe_controllers;

import jakarta.servlet.http.HttpServletRequest;
import org.springframework.boot.web.servlet.error.ErrorController;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
public class CustomErrorController implements ErrorController {
    @RequestMapping("/error")
    public String handleError(HttpServletRequest request) {
        // You can add custom logic to handle different types of errors based on the status code or other parameters
        return "error-page"; // the name of your error view
    }

}
