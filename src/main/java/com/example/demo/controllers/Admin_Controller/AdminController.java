package com.example.demo.controllers.Admin_Controller;


import com.example.demo.dtos.ajustes.ChangeGlobalSetting;
import com.example.demo.services.fe_services.AdminService;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

@Controller
//@RequestMapping("/admin")
public class AdminController {

    @Autowired
    AdminService adminService;

    @GetMapping("/usuarios")
    public String getUsuarios(Model model){

        return "usuarios";
    }
    @GetMapping("/ajustes")
    public String getAjustes(Model model, HttpSession session){
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        model.addAttribute("BonusBoasVindas", adminService.getGlobal("BonusBoasVindas").getValue());
        model.addAttribute("user", session.getAttribute("user"));

        return "ajustes";
    }

    @PostMapping("/changeBonusBoasVindas")
    public String changeBonusBoasVindas(@ModelAttribute ChangeGlobalSetting dto, Model model){


        adminService.changeGlobal("BonusBoasVindas",dto.value());

        return "redirect:/ajustes";
    }
}