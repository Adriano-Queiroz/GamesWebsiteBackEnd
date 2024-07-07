package com.example.demo.controllers.fe_controllers;

import com.example.demo.services.UsuariosService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.format.annotation.DateTimeFormat;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;

@Controller
public class UsuariosController {

    @Autowired
    private UsuariosService usuariosService;

    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd");

    @GetMapping("/usuarios")
    public String getUsuarios(@RequestParam(value = "startDate", required = false) String startDateStr,
                              @RequestParam(value = "endDate", required = false) String endDateStr,
                              Model model) {
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

            int activeUsers = usuariosService.getActiveUsersBetweenDates(startDate, endDate);
            model.addAttribute("activeUsers", activeUsers);

            int inactiveUsers = usuariosService.getInactiveUsersBetweenDates(startDate, endDate);
            model.addAttribute("inactiveUsers", inactiveUsers);
        } else {
            model.addAttribute("totalUsers", usuariosService.getTotalUsers());
            model.addAttribute("activeUsers", usuariosService.getActiveUsers());
            model.addAttribute("inactiveUsers", usuariosService.getInactiveUsers());
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
