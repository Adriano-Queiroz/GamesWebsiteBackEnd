package com.example.demo.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class FinanceController {

    @GetMapping("/saques")
    public String saques(Model model) {
        model.addAttribute("message", "Hello, Mambo!");
        return "saques";
    }
    @GetMapping("/depositos")
    public String depositos(Model model){
        return "depositos";
    }
}
