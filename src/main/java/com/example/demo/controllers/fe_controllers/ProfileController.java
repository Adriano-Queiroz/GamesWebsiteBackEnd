package com.example.demo.controllers.fe_controllers;

import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IUserModelRepository;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

@Controller
public class ProfileController {
    @Autowired
    private IUserModelRepository iuserRepository;
    @GetMapping("/admin-profile")
    public String profile(HttpSession session, Model model){
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        model.addAttribute("user", session.getAttribute("user"));

        return "perfil";
    }
    @PostMapping("/profile-atualizar")
    public String profileAtualizar(@ModelAttribute UserModel userChanges, Model model,HttpSession session){
        UserModel user = (UserModel) session.getAttribute("user");
        user.setCity(userChanges.getCity());
        user.setPhoneNumber(userChanges.getPhoneNumber());
        iuserRepository.save(user);
        session.setAttribute("user", user);
        return "redirect:/admin-profile";
    }
    @PostMapping("/profile-atualizar-notifications")
    public String updateNotifications(
            @RequestParam(value = "whatsappNotifications", required = false) boolean whatsappNotifications,
            @RequestParam(value = "generalNotifications", required = false) boolean generalNotifications,
            @RequestParam(value = "weeklyNewsletter", required = false) boolean weeklyNewsletter,
            RedirectAttributes redirectAttributes,
            HttpSession session) {
        UserModel user = (UserModel) session.getAttribute("user");
        user.setWhatsappNotifications(whatsappNotifications);
        user.setGeneralNotifications(generalNotifications);
        user.setWeeklyNewsletter(weeklyNewsletter);
        iuserRepository.save(user);
        session.setAttribute("user", user);

        return "redirect:/admin-profile";
    }
}
