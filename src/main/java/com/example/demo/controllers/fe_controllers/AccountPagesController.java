package com.example.demo.controllers.fe_controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class AccountPagesController {

    @GetMapping("/profile")
    public String profile(Model model){

        return "profile";
    }
    @GetMapping("/transactions")
    public String transactions(Model model){

        return "transactions";
    }
    @GetMapping("/bets")
    public String bets(Model model){

        return "bets";
    }
}
