package com.example.demo.controllers.fe_controllers;

import com.example.demo.services.fe_services.AdminService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class AjustesSuporteController {

    @Autowired
    private AdminService adminService;
    @GetMapping("/ajustes-suporte")
    public String ajustesSuporte(Model model){

        model.addAttribute("PixelFacebook", adminService.getSocialMedia("PixelFacebook"));
        model.addAttribute("TokenFacebook", adminService.getSocialMedia("TokenFacebook"));
        model.addAttribute("PixelMercadoPago", adminService.getSocialMedia("PixelMercadoPago"));
        model.addAttribute("LinkInstagram", adminService.getSocialMedia("LinkInstagram"));
        model.addAttribute("LinkWhatsapp", adminService.getSocialMedia("LinkWhatsapp"));
        model.addAttribute("LinkTelegram", adminService.getSocialMedia("LinkTelegram"));

        return "ajustes-suporte";
    }
}
