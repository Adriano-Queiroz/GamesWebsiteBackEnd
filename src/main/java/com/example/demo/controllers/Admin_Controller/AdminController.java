package com.example.demo.controllers.Admin_Controller;


import com.example.demo.dtos.ajustes.ChangeGlobalSettingDTO;
import com.example.demo.dtos.ajustes.ChangeSocialMediaDTO;
import com.example.demo.dtos.ajustes.CreditUserBalanceDTO;
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


    @GetMapping("/ajustes")
    public String getAjustes(Model model, HttpSession session){
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        model.addAttribute("BonusBoasVindas", adminService.getGlobal("BonusBoasVindas"));
        model.addAttribute("BonusRecargaDiaria", adminService.getGlobal("BonusRecargaDiaria"));
        model.addAttribute("BonusPrimeiraRecarga", adminService.getGlobal("BonusPrimeiraRecarga"));
        model.addAttribute("ConfigLucro", adminService.getGlobal("ConfigLucro"));

        model.addAttribute("Salas", adminService.getRooms());

        model.addAttribute("PixelFacebook", adminService.getSocialMedia("PixelFacebook"));
        model.addAttribute("TokenFacebook", adminService.getSocialMedia("TokenFacebook"));
        model.addAttribute("PixelMercadoPago", adminService.getSocialMedia("PixelMercadoPago"));
        model.addAttribute("LinkInstagram", adminService.getSocialMedia("LinkInstagram"));
        model.addAttribute("LinkWhatsapp", adminService.getSocialMedia("LinkWhatsapp"));
        model.addAttribute("LinkTelegram", adminService.getSocialMedia("LinkTelegram"));



        model.addAttribute("user", session.getAttribute("user"));

        return "ajustes";
    }

    @PostMapping("/changeBonusBoasVindas")
    public String changeBonusBoasVindas(@ModelAttribute ChangeGlobalSettingDTO dto, Model model){
        adminService.changeGlobal("BonusBoasVindas",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/changeBonusRecargaDiaria")
    public String changeBonusRecargaDiaria(@ModelAttribute ChangeGlobalSettingDTO dto, Model model){
        adminService.changeGlobal("BonusRecargaDiaria",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/changeBonusPrimeiraRecarga")
    public String changeBonusPrimeiraRecarga(@ModelAttribute ChangeGlobalSettingDTO dto, Model model){
        adminService.changeGlobal("BonusPrimeiraRecarga",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/changeConfigLucro")
    public String changeConfigLucro(@ModelAttribute ChangeGlobalSettingDTO dto, Model model){
        adminService.changeGlobal("ConfigLucro",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/changePixelFacebook")
    public String changePixelFacebook(@ModelAttribute ChangeSocialMediaDTO dto, Model model){
        adminService.changeSocialMedia("PixelFacebook",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/changeTokenFacebook")
    public String changeTokenFacebook(@ModelAttribute ChangeSocialMediaDTO dto, Model model){
        adminService.changeSocialMedia("TokenFacebook",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/changePixelMercadoPago")
    public String changePixelMercadoPago(@ModelAttribute ChangeSocialMediaDTO dto, Model model){
        adminService.changeSocialMedia("PixelMercadoPago",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/changeLinkInstagram")
    public String changeLinkInstagram(@ModelAttribute ChangeSocialMediaDTO dto, Model model){
        adminService.changeSocialMedia("LinkInstagram",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/changeLinkWhatsapp")
    public String changeLinkWhatsapp(@ModelAttribute ChangeSocialMediaDTO dto, Model model){
        adminService.changeSocialMedia("LinkWhatsapp",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/changeLinkTelegram")
    public String changeLinkTelegram(@ModelAttribute ChangeSocialMediaDTO dto, Model model){
        adminService.changeSocialMedia("LinkTelegram",dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/creditUserBalance")
    public String creditUserBalance(@ModelAttribute CreditUserBalanceDTO dto, Model model){
        adminService.creditUserBalance(dto.cpf(),dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/creditUserBonusBalance")
    public String creditUserBonusBalance(@ModelAttribute CreditUserBalanceDTO dto, Model model){
        adminService.creditUserBonusBalance(dto.cpf(),dto.value());
        return "redirect:/ajustes";
    }

    @PostMapping("/AddRoom")
    public String addRoom(@RequestParam String name, @RequestParam double bet , Model model){
        adminService.addRoom(name, bet);
        return "redirect:/ajustes";
    }

    @PostMapping("/removeRoom")
    public String removeRoom(@RequestParam Long salaId, Model model){
        adminService.removeRoom(salaId);
        return "redirect:/ajustes";
    }

}
