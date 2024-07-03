package com.example.demo.controllers.fe_controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class Home {
    @GetMapping("/index")
    public String index(Model model){
        return "index";
    }
}
