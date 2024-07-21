package com.example.demo.controllers.fe_controllers.admin;

import com.example.demo.dtos.user.FeUserDTO;
import com.example.demo.models.user.UserModel;
import com.example.demo.models.user.role.UserRoles;
import com.example.demo.services.UsuariosService;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.List;

@Controller
public class UsuariosController {

    @Autowired
    private UsuariosService usuariosService;

    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd");

    @GetMapping("/usuarios")
    public String getUsuarios(@RequestParam(value = "startDate", required = false) String startDateStr,
                              @RequestParam(value = "endDate", required = false) String endDateStr,
                              HttpSession session,
                              Model model) {
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        UserModel user = (UserModel) session.getAttribute("user");
        if(!user.getUserRole().getUserRole().equals(UserRoles.ADMIN))
            return "redirect:/login";

        LocalDate startDate = null;
        LocalDate endDate = null;
        try {
            if (startDateStr != null) {
                startDate = LocalDate.parse(startDateStr, DATE_FORMATTER);
            }
            if (endDateStr != null) {
                endDate = LocalDate.parse(endDateStr, DATE_FORMATTER);
            }
        } catch (DateTimeParseException e) {
            // Handle the exception, e.g., set default dates or show an error message
        }

        if (startDate != null && endDate != null) {
            int totalUsers = usuariosService.getTotalUsersBeforeEndDate(endDate);
            model.addAttribute("totalUsers", totalUsers);

            int activeUsers = usuariosService.getCountActiveUsersBetweenDates(startDate, endDate);
            model.addAttribute("activeUsers", activeUsers);

            int inactiveUsers = usuariosService.getCountInactiveUsersBetweenDates(startDate, endDate);
            model.addAttribute("inactiveUsers", inactiveUsers);

            List<FeUserDTO> allUsersList = usuariosService.getAllUsersBetweenDates(endDate);
            model.addAttribute("allUsersList", allUsersList);

            List<FeUserDTO> inactiveUsersList = usuariosService.getInactiveUsersBetweenDates(startDate,endDate);
            model.addAttribute("inactiveUsersList", inactiveUsersList);

            List<FeUserDTO> activeUsersList = usuariosService.getActiveUsersBetweenDates(startDate,endDate);
            model.addAttribute("activeUsersList", activeUsersList);


        } else {
            model.addAttribute("totalUsers", usuariosService.getTotalUsers());
            model.addAttribute("activeUsers", usuariosService.getCountActiveUsers());
            model.addAttribute("inactiveUsers", usuariosService.getCountInactiveUsers());
            model.addAttribute("allUsersList", usuariosService.getAllUsers());
            model.addAttribute("inactiveUsersList", usuariosService.getAllInactiveUsers());
            model.addAttribute("activeUsersList", usuariosService.getAllActiveUsers());

        }
        model.addAttribute("startDate", startDate != null ? startDate.toString() + " -" : "(Desde o Início)");
        model.addAttribute("endDate", endDate != null ? endDate.toString() : "");

        return "usuarios";
    }

    @PostMapping("/usuarios-date")
    public String handleDateSubmission(@RequestParam("startDate") String startDateStr,
                                       @RequestParam("endDate") String endDateStr,
                                       RedirectAttributes redirectAttributes) {
        if (!startDateStr.equals("") && !endDateStr.equals("")) {
            LocalDate startDate = LocalDate.parse(startDateStr, DATE_FORMATTER);
            LocalDate endDate = LocalDate.parse(endDateStr, DATE_FORMATTER);
        }

        // Add attributes to RedirectAttributes
        redirectAttributes.addAttribute("startDate", startDateStr);
        redirectAttributes.addAttribute("endDate", endDateStr);

        // Redirect to the GET /usuarios with parameters
        return "redirect:/usuarios";
    }
}
