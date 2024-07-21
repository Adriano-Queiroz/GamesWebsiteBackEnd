package com.example.demo.controllers.fe_controllers;

import com.example.demo.models.user.UserModel;
import com.example.demo.models.user.role.UserRoles;
import com.example.demo.services.fe_services.AdminService;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class AjustesSuporteController {

    @Autowired
    private AdminService adminService;
    @GetMapping("/ajustes-suporte")
    public String ajustesSuporte(HttpSession session, Model model){
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        UserModel user = (UserModel) session.getAttribute("user");
        if(!user.getUserRole().equals( UserRoles.ADMIN))
            return "redirect:/login";

        model.addAttribute("PixelFacebook", adminService.getSocialMedia("PixelFacebook"));
        model.addAttribute("TokenFacebook", adminService.getSocialMedia("TokenFacebook"));
        model.addAttribute("PixelMercadoPago", adminService.getSocialMedia("PixelMercadoPago"));
        model.addAttribute("LinkInstagram", adminService.getSocialMedia("LinkInstagram"));
        model.addAttribute("LinkWhatsapp", adminService.getSocialMedia("LinkWhatsapp"));
        model.addAttribute("LinkTelegram", adminService.getSocialMedia("LinkTelegram"));

        return "ajustes-suporte";
    }
}
