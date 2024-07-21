package com.example.demo.controllers.fe_controllers;

import jakarta.servlet.http.HttpSession;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class Home {
    @GetMapping("/index")
    public String index(HttpSession session, Model model){
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        return "index";
    }
}
