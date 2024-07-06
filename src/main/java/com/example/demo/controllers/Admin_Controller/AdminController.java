package com.example.demo.controllers.Admin_Controller;


import com.example.demo.dtos.ajustes.ChangeBonusBoasVindasDTO;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

@Controller
//@RequestMapping("/admin")
public class AdminController {

    @GetMapping("/usuarios")
    public String getUsuarios(Model model){

        return "usuarios";
    }
    @GetMapping("/ajustes")
    public String getAjustes(Model model){

        return "ajustes";
    }

    @PostMapping("/changeBonusBoasVindas")
    public String changeBonusBoasVindas(@ModelAttribute ChangeBonusBoasVindasDTO dto, Model model){


        return "redirect:/ajustes";
    }
}
